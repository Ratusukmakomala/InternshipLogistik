<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Transaction\CodExport;
use App\Exports\Transaction\SearchExport;
use App\Exports\Transaction\SenderExport;
use App\Exports\Transaction\DeliveryExport;
use App\Exports\Transaction\ReceiverExport;
use App\Services\Transaction\ReportService;
use App\Http\Requests\Transaction\SearchRequest;

class ReportExportController extends Controller
{
    public function __construct(public ReportService $reportService)
    {}

    public function deliveryExport()
    {
        $today = Carbon::now()->format('d-m-Y');
        return Excel::download(new DeliveryExport($this->reportService), "Report delivery $today.xlsx");
    }

    public function senderExport()
    {
        $today = Carbon::now()->format('d-m-Y');
        return Excel::download(new SenderExport($this->reportService), "Report sender delivery $today.xlsx");
    }

    public function receiverExport()
    {
        $today = Carbon::now()->format('d-m-Y');
        return Excel::download(new ReceiverExport($this->reportService), "Report receiver delivery $today.xlsx");
    }

    public function codExport()
    {
        $today = Carbon::now()->format('d-m-Y');
        return Excel::download(new CodExport($this->reportService), "Report cod $today.xlsx");
    }

    public function searchExport()
    {
        $search = session('search-report');
        $today = Carbon::now()->format('d-m-Y');
        return Excel::download(new SearchExport($this->reportService, $search), "Report by search $today.xlsx");
    }
}
