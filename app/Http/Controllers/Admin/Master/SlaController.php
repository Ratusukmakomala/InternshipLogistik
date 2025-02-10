<?php

namespace App\Http\Controllers\Admin\Master;

use App\Services\SlaService;
use App\Http\Controllers\Controller;
use App\Models\ServiceLevelAgreement;
use App\Http\Requests\Admin\Master\Sla\StoreServiceLevelAgreementRequest;
use App\Http\Requests\Admin\Master\Sla\UpdateServiceLevelAgreementRequest;

class SlaController extends Controller
{
    public function __construct(public SlaService $sla)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slas = $this->sla->findAll(10);
        confirmDelete("Delete Service Level Agreement", "Are you sure you want to delete this Service Level Agreement?");
        return view('admin.master.sla.index', compact('slas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master.sla.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceLevelAgreementRequest $request)
    {
        $this->sla->store($request);
        return to_route('admin.master.slas.index')->with('success', 'Service Level Agreement created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceLevelAgreement $sla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceLevelAgreement $sla)
    {
        return view('admin.master.sla.edit', compact('sla'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceLevelAgreementRequest $request, ServiceLevelAgreement $sla)
    {
        $this->sla->update($request, $sla);
        return to_route('admin.master.slas.index')->with('success', 'Service Level Agreement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceLevelAgreement $sla)
    {
        $this->sla->destroy($sla->id);
        return to_route('admin.master.slas.index')->with('success', 'Service Level Agreement deleted successfully');
    }
}
