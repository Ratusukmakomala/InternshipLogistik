<?php

namespace App\Services;

use App\Models\Partner;
use App\Http\Requests\Admin\Master\Partner\StorePartnerRequest;
use App\Http\Requests\Admin\Master\Partner\UpdatePartnerRequest;

class PartnerService
{
    public function __construct(public Partner $partner)
    {

    }

    public function findAll($limit = 10)
    {
        return $this->partner->latest()->paginate($limit);
    }

    public function findById($partner)
    {
        return Partner::find($partner);
    }

    public function lists()
    {
        return $this->partner->get()->pluck('name', 'id')->toArray();
    }

    public function listIds()
    {
        return $this->partner->get()->pluck('id')->toArray();
    }

    public function store(StorePartnerRequest $request)
    {
        try {
            return $this->partner->create([
                'type'      => $request->type,
                'code'      => $request->code,
                'name'      => $request->name,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdatePartnerRequest $request, $partner)
    {
        try {
            $partner->update([
                'type'      => $request->type,
                'code'      => $request->code,
                'name'      => $request->name,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($partner)
    {
        $oldPartner = $this->partner->find($partner);
        $oldPartner->delete();
    }
}
