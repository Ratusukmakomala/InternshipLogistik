<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Models\Transaction\History;
use App\Http\Controllers\Controller;
use App\Services\Transaction\ReportService;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $reportService = new ReportService();

        if (auth()->user()->role_id == 1) {
            $totalTransactionAllTime = $reportService->totalTransaction();
            $totalTransactionYesterday = $reportService->totalTransaction(now()->subDay()->startOfDay(), now()->subDay()->endOfDay());
            $totalTransactionLastMonth = $reportService->totalTransaction(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth());
            $totalTransactionLastYear = $reportService->totalTransaction(now()->subYear()->startOfYear(), now()->subYear()->endOfYear());
            $shippingFormTransactions = $reportService->groupByShippingForm();
            $kindDeliveryTransactions = $reportService->groupByKindDelivery();
            $deliveryTypeTransactions = $reportService->groupByDeliveryType();

            return view('dashboard.index', compact(
                'totalTransactionAllTime',
                'totalTransactionYesterday',
                'totalTransactionLastMonth',
                'totalTransactionLastYear',
                'shippingFormTransactions',
                'kindDeliveryTransactions',
                'deliveryTypeTransactions'
            ));
        } else {
            $totalTransactionSender = $reportService->findCustomerTransactions(isSender: true, isCount: true);
            $totalTransactionReceiver = $reportService->findCustomerTransactions(isSender: false, isCount: true);

            return view('dashboard.index', compact(
                'totalTransactionSender',
                'totalTransactionReceiver'
            ));
        }
    }
}
