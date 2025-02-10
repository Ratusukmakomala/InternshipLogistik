<?php

namespace App\Services\Transaction;

use Carbon\Carbon;
use App\Models\Customer;
use App\Enums\TransactionTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Transaction\SearchRequest;
use App\Models\Transaction\History;

class ReportService
{
    public function findAll($limit = 10, $isExport = false)
    {
        $reports = DB::table('reports');
        if ($isExport) {
            return $reports->get();
        } else {
            return $reports->paginate($limit);
        }
    }

    public function findAllInArray()
    {
        return DB::table('reports')
        ->select('delivery_type', 'sla_status', 'shipping_form', 'weight', 'volume', 'base_price','sla_id', 'kind_delivery')
        ->get()->toArray();
    }

    public function findByCod($limit = 10, $isExport = false)
    {
        $reports = DB::table('reports')
        ->whereDeliveryType('cod');
        if($isExport) {
            return $reports->get();
        } else {
            return $reports->paginate($limit);
        }
    }

    public function findHistoriesByTransactionId($transactionId, $limit = 10)
    {
        return History::with('senderOffice', 'receiverOffice')
        ->whereTransactionId($transactionId)
        ->orderBy('change_status_date', 'DESC')
        ->paginate($limit);
    }

    public function findCustomerTransactions($isSender = null, $isExport = false, $isCount = null, $limit = 10)
    {
        $customer = Customer::with('user', 'user.role')->where('user_id', auth()->user()->id)->first();

        $reports = DB::table('reports')
            ->when($isSender == true, function($query) use($customer) {
                $query->where('sender_id', $customer->id);
            })
            ->when($isSender == false, function($query) use($customer) {
                $query->where('receiver_id', $customer->id);
            });

            if($isExport) {
                return $reports->get();
            } else {
                if($isCount) {
                    return $reports->count();
                } else {
                    return $reports->paginate($limit);
                }
            }
    }

    public function seacrhResult(SearchRequest $request, $limit = 10, $isExport = false)
    {
        $reports = DB::table('reports')
        ->when($request->transaction_from && $request->transaction_to, function($query) use($request) {
            $query->whereBetween('transaction_date', [$request->transaction_from, $request->transaction_to]);
        })
        ->when($request->transaction_type, function($query) use($request) {
            $query->whereType($request->transaction_type);
        })
        ->when($request->delivery_type, function($query) use($request) {
            $query->whereDeliveryType($request->delivery_type);
        })
        ->when($request->transaction_status, function($query) use($request) {
            $query->whereStatus($request->transaction_status);
        })
        ->when($request->partner_name, function($query) use($request) {
            $query->where('partner_name', 'like', '%'.$request->partner_name.'%');
        })
        ->when($request->sender_name, function($query) use($request) {
            $query->where('sender_name', 'like', '%'.$request->sender_name.'%');
        })
        ->when($request->receiver_name, function($query) use($request) {
            $query->where('receive_name', 'like', '%'.$request->receiver_name.'%');
        });

        if($isExport) {
            return $reports->get();
        } else {
            return $reports->paginate($limit);
        }
    }

    public function totalTransaction($from = null, $to = null)
    {
        return DB::table('reports')
            ->when($from && $to, function($query) use($from, $to) {
                $query->whereBetween('transaction_date', [Carbon::parse($from)->format('Y-m-d'), Carbon::parse($to)->format('Y-m-d')]);
            })
        ->count();
    }

    public function groupByShippingForm()
    {
        return DB::table('reports')
            ->select('shipping_form', DB::raw('count(*) as total'))
            ->groupBy('shipping_form')
            ->get();
    }

    public function groupByKindDelivery()
    {
        return DB::table('reports')
            ->select('kind_delivery', DB::raw('count(*) as total'))
            ->groupBy('kind_delivery')
            ->get();
    }

    public function groupByType()
    {
        return DB::table('reports')
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();
    }

    public function groupByDeliveryType()
    {
        return DB::table('reports')
            ->select('delivery_type', DB::raw('count(*) as total'))
            ->groupBy('delivery_type')
            ->get();
    }


    public function transactionTypeLists()
    {
        return [
            TransactionTypeEnum::customer->name,
            TransactionTypeEnum::partner->name
        ];
    }

    public function deliveryTypeLists()
    {
        return [
            'cod',
            'non cod'
        ];
    }

    public function statusDeliveryLists()
    {
        return [
            'pending',
            'on delivery',
            'success',
            'failed'
        ];
    }
}
