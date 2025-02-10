<?php

namespace Database\Factories\Transaction;

use Carbon\Carbon;
use App\Models\Office;
use App\Models\Partner;
use App\Models\Customer;
use App\Models\Transaction\History;
use App\Models\Transaction\TPartner;
use App\Models\ServiceLevelAgreement;
use App\Models\Transaction\TCustomer;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\CashOnDelivery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction\Transaction>
 */
class TransactionFactory extends Factory
{
    protected static $lastInvoiceNumber = null;

    public function definition(): array
    {
        $slas               = $this->listIds();
        $invoiceNumber      = $this->invoiceGenerator();
        $transactionDate    = $this->faker->dateTimeBetween('-1 year', 'now');
        $receiveDate        = $this->faker->dateTimeBetween($transactionDate, '+1 year');
        $kindOfDelivery     = $this->faker->randomElement(['document', 'package']);
        $shippingForm       = $this->getShippingForm($kindOfDelivery);
        $slaId              = $this->faker->randomElement($slas);
        $slaActual          = $this->faker->numberBetween(1, 4);
        $slaStatus          = $this->slaStatus($slaActual, $slaId);
        $type               = 'customer';
        $deliveryType       = $this->faker->randomElement(['cod', 'non cod']);
        $weight             = $this->faker->randomFloat(2, 0.1, 100);
        $volume             = $this->faker->randomFloat(2, 0.1, 100);
        $itemValue          = $this->faker->randomFloat(2, 0.1, 100);
        $basePrice          = $this->faker->randomFloat(2, 0.1, 100);
        $taxPrice           = $this->faker->randomFloat(2, 0.1, 100);
        $status             = $this->faker->randomElement(['pending', 'on delivery', 'success', 'failed']);
        $note               = $this->faker->randomElement(['fragile', 'handle with care', 'urgent', 'important']);

        return [
            'receipt_number'        => $invoiceNumber,
            'transaction_date'      => $transactionDate,
            'first_delivery_date'   => $transactionDate,
            'receive_date'          => $receiveDate,
            'shipping_form'         => $shippingForm,
            'sla_id'                => $slaId,
            'sla_actual'            => $slaActual,
            'sla_status'            => $slaStatus,
            'kind_delivery'         => $kindOfDelivery,
            'type'                  => $type,
            'delivery_type'         => $deliveryType,
            'weight'                => $weight,
            'volume'                => $volume,
            'item_value'            => $itemValue,
            'base_price'            => $basePrice,
            'tax_price'             => $taxPrice,
            'status'                => $status,
            'note'                  => $note,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Transaction $transaction){
            if ($transaction->delivery_type === 'cod') {
                $paymentDate = $this->faker->dateTimeBetween('-1 year', 'now');
                $dueDate = (clone $transaction->first_delivery_date)->modify('+7 days');
                $codStatus = $paymentDate <= $dueDate ? 'paid' : 'pending';

                CashOnDelivery::create([
                    'transaction_id'    => $transaction->id,
                    'payment_date'      => $paymentDate,
                    'payment_due_date'  => $dueDate,
                    'payment_status'    => $codStatus,
                ]);
            }

            if ($transaction->type === 'customer') {
                $customerLists  = $this->customerListIds();
                $senderIds      = $this->faker->randomElement($customerLists);
                $receiverIds    = $this->faker->randomElement($customerLists);

                TCustomer::create([
                    'transaction_id'    => $transaction->id,
                    'sender_id'         => $senderIds,
                    'receiver_id'       => $receiverIds,
                ]);
            }

            $officeIds = $this->officeListIds();
            $senderIds = $this->faker->randomElement($officeIds);
            $receiverIds = $this->faker->randomElement($officeIds);
            $historyStatuses = ['pending', 'on delivery'];
            if ($transaction->status === 'success') {
                $historyStatuses[] = 'success';
            } else {
                $historyStatuses[] = 'failed';
            }
            foreach ($historyStatuses as $status) {
                History::create([
                    'transaction_id'        => $transaction->id,
                    'sender_office_id'      => $senderIds,
                    'receiver_office_id'    => $receiverIds,
                    'change_status_date'    => $this->faker->dateTimeBetween($transaction->transaction_date, $transaction->receive_date),
                    'status'                => $status,
                ]);
            }
        });
    }

    private function slaStatus($actual, $slaId)
    {
        $sla = ServiceLevelAgreement::find($slaId);
        if($sla->target < $actual) {
            return false;
        }

        return true;
    }

    private function getShippingForm($kindOfDelivery)
    {
        if ($kindOfDelivery === 'document') {
            return $this->faker->randomElement(['letter', 'envelope', 'parcel']);
        } else {
            return $this->faker->randomElement(['box', 'crate', 'pallet', 'electronic']);
        }
    }

    public function invoiceGenerator()
    {
        $invoiceCode = 'INV-';
        $invoiceDate = Carbon::now()->format('Ymd');

        if (is_null(self::$lastInvoiceNumber)) {
            $latestTransactionId = Transaction::max('id');
            if ($latestTransactionId) {
                $uniqueCode = str_pad($latestTransactionId + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $uniqueCode = '00001';
            }
        } else {
            $uniqueCode = str_pad(self::$lastInvoiceNumber + 1, 5, '0', STR_PAD_LEFT);
        }

        self::$lastInvoiceNumber = (int) $uniqueCode;

        $invoiceResult = $invoiceCode . $invoiceDate . $uniqueCode;
        return $invoiceResult;
    }

    public function listIds()
    {
        return ServiceLevelAgreement::get()->pluck('id')->toArray();
    }

    public function partnerListIds()
    {
        return Partner::get()->pluck('id')->toArray();
    }

    public function customerListIds()
    {
        return Customer::get()->pluck('id')->toArray();
    }

    public function officeListIds()
    {
        return Office::get()->pluck('id')->toArray();
    }
}
