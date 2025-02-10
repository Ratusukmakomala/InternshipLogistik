<?php

namespace App\Exports\Transaction;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Services\Transaction\ReportService;
use App\Http\Requests\Transaction\SearchRequest;

class SearchExport implements FromView
{
    public function __construct(
        public ReportService $reportService,
        public $request
    ) {}

    public function view() : View {
        $searchResult = $this->convertArrayToSearchRequest($this->request);
        $reports = $this->reportService->seacrhResult($searchResult, isExport: true);
        return view('export.transaction.search', compact('reports'));
    }

    private function convertArrayToSearchRequest(array $data): SearchRequest
    {
        $request = new SearchRequest();

        // Manually set the request data
        $request->merge($data);

        // Validate the request
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // Prepare for validation (this will call the prepareForValidation method)
        $request->prepareForValidation();

        return $request;
    }
}
