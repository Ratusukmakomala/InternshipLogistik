<?php

namespace App\Exports\Transaction;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Services\Transaction\ReportService;

class DeliveryExport implements FromView
{
    public function __construct(
        public ReportService $reportService
    ) {}

    public function view() : View {
        $reports = $this->reportService->findAll(isExport: true);
        return view('export.transaction.delivery', compact('reports'));
    }
}
