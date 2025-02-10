<?php

namespace App\Services;

use App\Enums\OfficeTypeEnum;
use App\Models\Office;
use App\Http\Requests\Admin\Master\Office\StoreOfficeRequest;
use App\Http\Requests\Admin\Master\Office\UpdateOfficeRequest;

class OfficeService
{
    public function __construct(public Office $office)
    {

    }

    public function findAll($limit = 10)
    {
        return $this->office->latest()->paginate($limit);
    }

    public function getListParents()
    {
        return $this->office->where('type', '!=', OfficeTypeEnum::KCP)->get()->pluck('code', 'id')->toArray();
    }

    public function listIds()
    {
        return $this->office->get()->pluck('id')->toArray();
    }

    public function findById($office)
    {
        return Office::find($office);
    }

    public function store(StoreOfficeRequest $request)
    {
        try {
            return $this->office->create([
                'parent_id' => $request->parent_id,
                'code'      => $request->code,
                'name'      => $request->name,
                'region'    => $request->region,
                'type'      => $request->type,
                'address'   => $request->address,
                'zip_code'  => $request->zip_code,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateOfficeRequest $request, $office)
    {
        try {
            $office->update([
                'parent_id' => $request->parent_id,
                'code'      => $request->code,
                'name'      => $request->name,
                'region'    => $request->region,
                'type'      => $request->type,
                'address'   => $request->address,
                'zip_code'  => $request->zip_code,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($office)
    {
        $oldOffice = $this->office->find($office);
        $oldOffice->delete();
    }
}
