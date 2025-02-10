<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Partner;
use App\Enums\PartnerTypeEnum;
use App\Services\PartnerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Partner\StorePartnerRequest;
use App\Http\Requests\Admin\Master\Partner\UpdatePartnerRequest;

class PartnerController extends Controller
{
    public function __construct(public PartnerService $partnerService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = $this->partnerService->findAll(10);
        confirmDelete("Delete Partner", "Are you sure you want to delete this Partner?");
        return view('admin.master.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = [
            PartnerTypeEnum::marketplace->name,
            PartnerTypeEnum::pemerintah->name,
            PartnerTypeEnum::perbankan->name,
        ];
        return view('admin.master.partner.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $this->partnerService->store($request);
        return redirect()->route('admin.master.partners.index')->with('success', 'Data partner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        $types = [
            PartnerTypeEnum::marketplace->name,
            PartnerTypeEnum::pemerintah->name,
            PartnerTypeEnum::perbankan->name,
        ];
        return view('admin.master.partner.edit', compact('partner', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $this->partnerService->update($request, $partner);
        return redirect()->route('admin.master.partners.index')->with('success', 'Data partner berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $this->partnerService->destroy($partner->id);
        return redirect()->route('admin.master.partners.index')->with('success', 'Data partner berhasil dihapus');
    }
}
