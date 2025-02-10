<?php

namespace App\Http\Controllers\Transaction;

use App\Services\SlaService;
use Illuminate\Http\Request;
use App\Services\PartnerService;
use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionService;
use App\Http\Requests\Transaction\TrackingRequest;
use App\Http\Requests\Transaction\CreateTransactionRequest;

class DeliveryController extends Controller
{
    public function __construct(
        public TransactionService $transactionService,
        public SlaService $slaService,
        public PartnerService $partnerService,
        public CustomerService $customerService
    )
    {

    }

    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaction.delivery.tracking');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slas = $this->slaService->lists();
        $kindOfDeliveries = $this->transactionService->kindOfDeliveryLists();
        $types = $this->transactionService->typeLists();
        $deliveryTypes = $this->transactionService->deliveryTypeLists();
        $customers = $this->customerService->lists();
        $partners = $this->partnerService->lists();
        return view('transaction.delivery.create', compact('slas', 'kindOfDeliveries', 'types', 'deliveryTypes', 'customers', 'partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTransactionRequest $request)
    {
        $this->transactionService->store($request);
        return redirect()->back()->with('success', 'Transaction created successfully');
    }

    public function detailTracking(TrackingRequest $request)
    {
        $delivery = $this->transactionService->findByInvoice($request->search);
        return view('transaction.delivery.tracking-detail', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
