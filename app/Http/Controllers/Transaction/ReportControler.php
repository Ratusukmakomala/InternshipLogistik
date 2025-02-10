<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\SearchRequest;
use App\Services\Transaction\ReportService;

class ReportControler extends Controller
{
    public function __construct(
        public ReportService $reportService
        )
    {}

    public function index()
    {
        $reports = $this->reportService->findAll();
        return view('transaction.report.daily', compact('reports'));
    }

    public function cod()
    {
        $reports = $this->reportService->findByCod();
        return view('transaction.report.cod', compact('reports'));
    }

    public function showHistory($id)
    {
        $histories = $this->reportService->findHistoriesByTransactionId($id);
        return view('transaction.report.history', compact('histories'));
    }

    public function search()
    {
        $transactionTypes = $this->reportService->transactionTypeLists();
        $deliveryTypes = $this->reportService->deliveryTypeLists();
        $transactionStatuses = $this->reportService->statusDeliveryLists();
        return view('transaction.report.search', compact('transactionTypes', 'deliveryTypes', 'transactionStatuses'));
    }

    public function searchResult(SearchRequest $request)
    {
        $reports = $this->reportService->seacrhResult($request);
        session(['search-report' => $request->all()]);
        return view('transaction.report.search-result', compact('reports', 'request'));
    }

    public function senderReport()
    {
        $reports = $this->reportService->findCustomerTransactions(true, false);
        return view('transaction.report.sender', compact('reports'));
    }

    public function receiverReport()
    {
        $reports = $this->reportService->findCustomerTransactions(false, isExport: false);
        return view('transaction.report.receiver', compact('reports'));
    }
}
