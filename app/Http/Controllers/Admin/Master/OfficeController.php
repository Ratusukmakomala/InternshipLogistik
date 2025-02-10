<?php

namespace App\Http\Controllers\Admin\Master;

use App\Enums\OfficeTypeEnum;
use App\Models\Office;
use App\Services\OfficeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Office\StoreOfficeRequest;
use App\Http\Requests\Admin\Master\Office\UpdateOfficeRequest;

class OfficeController extends Controller
{
    public function __construct(public OfficeService $officeService)
    {
    }

    public function index()
    {
        $offices = $this->officeService->findAll(10);
        confirmDelete("Delete Office", "Are you sure you want to delete this Office?");
        return view('admin.master.office.index', compact('offices'));
    }

    public function create()
    {
        $parents    = $this->officeService->getListParents();
        $types      = [
            OfficeTypeEnum::KCU->name,
            OfficeTypeEnum::KC->name,
            OfficeTypeEnum::KCP->name,
        ];
        return view('admin.master.office.create', compact('parents', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
        $this->officeService->store($request);
        return redirect()->route('admin.master.offices.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        $parents    = $this->officeService->getListParents();
        $types      = [
            OfficeTypeEnum::KCU->name,
            OfficeTypeEnum::KC->name,
            OfficeTypeEnum::KCP->name,
        ];
        return view('admin.master.office.edit', compact('office', 'parents', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $this->officeService->update($request, $office);
        return redirect()->route('admin.master.offices.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $this->officeService->destroy($office->id);
        return redirect()->route('admin.master.offices.index')->with('success', 'Data berhasil dihapus');
    }
}
