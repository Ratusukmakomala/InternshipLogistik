<?php

namespace App\Services\Transaction;

use Carbon\Carbon;
use App\Enums\DeliveryTypeEnum;
use App\Enums\KindOfDeliveryEnum;
use App\Enums\TransactionTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction\History;
use App\Models\Transaction\TPartner;
use App\Models\Transaction\TCustomer;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\CashOnDelivery;
use App\Http\Requests\Transaction\CreateTransactionRequest;

class TransactionService
{
    public function __construct(
        public Transaction $transaction,
        public CashOnDelivery $cashOnDelivery,
        public History $history,
        public TCustomer $tCustomer,
        public TPartner $tPartner
    )
    {
        //
    }

    public function findByInvoice($invoiceCode)
    {
        return $this->transaction::with([
            'histories' => function ($query) {
                $query->orderBy('id', 'desc');
            },
            'histories.senderOffice',
            'histories.receiverOffice'
            ])
            ->where('receipt_number', $invoiceCode)
            ->first();
    }

    public function store(CreateTransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->transaction->create([
                'receipt_number'    => $this->invoiceGenerator(),
                'transaction_date'  => Carbon::now()->format('Y-m-d H:i:s'),
                'shipping_form'     => $request->shipping_form,
                'type_of_goods'     => $request->type_of_goods,
                'sla_id'            => $request->sla_id,
                'kind_of_delivery'  => $request->kind_of_delivery,
                'type'              => $request->type,
                'delivery_type'     => $request->delivery_type,
                'weight'            => $request->weight,
                'volume'            => $request->volume,
                'item_value'        => $request->item_value,
                'base_price'        => $request->base_price,
                'tax_price'         => $request->tax_price,
                'note'              => $request->note,
            ]);

            if ($transaction->delivery_type === 'cod') {
                $this->cashOnDelivery->create([
                    'transaction_id'    => $transaction->id,
                    'payment_due_date'  => Carbon::now()->addDays(7)->format('Y-m-d'),
                ]);
            }

            if ($transaction->type === 'customer') {
                $this->tCustomer->create([
                    'transaction_id'    => $transaction->id,
                    'sender_id'         => $request->sender_id,
                    'receiver_id'       => $request->receiver_id,
                ]);
            } else {
                $this->tPartner->create([
                    'transaction_id'    => $transaction->id,
                    'partner_id'        => $request->partner_id,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function invoiceGenerator()
    {
        $invoiceCode = 'INV-';
        $invoiceDate = Carbon::now()->format('Ymd');

        $latestTransactionId = $this->transaction->max('id');
        if ($latestTransactionId) {
            $uniqueCode = str_pad($latestTransactionId + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $uniqueCode = '00001';
        }

        $invoiceResult = $invoiceCode . $invoiceDate . $uniqueCode;
        return $invoiceResult;
    }

    public function kindOfDeliveryLists()
    {
        return [
            KindOfDeliveryEnum::document->name,
            KindOfDeliveryEnum::package->name,
        ];
    }

    public function typeLists()
    {
        return [
            TransactionTypeEnum::customer->name,
            TransactionTypeEnum::partner->name,
        ];
    }

    public function deliveryTypeLists()
    {
        return [
            DeliveryTypeEnum::cod->name,
            DeliveryTypeEnum::noncod->name,
        ];
    }
}
