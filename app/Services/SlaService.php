<?php

namespace App\Services;

use App\Models\ServiceLevelAgreement;
use App\Http\Requests\Admin\Master\Sla\StoreServiceLevelAgreementRequest;
use App\Http\Requests\Admin\Master\Sla\UpdateServiceLevelAgreementRequest;

class SlaService
{
    public function __construct(public ServiceLevelAgreement $sla)
    {

    }

    public function findAll($limit = 10)
    {
        return $this->sla::latest()->paginate($limit);
    }

    public function findById($sla)
    {
        return ServiceLevelAgreement::find($sla);
    }

    public function lists()
    {
        return $this->sla->get()->pluck('name', 'id')->toArray();
    }

    public function listIds()
    {
        return $this->sla->get()->pluck('id')->toArray();
    }

    public function store(StoreServiceLevelAgreementRequest $request)
    {
        try {
            return $this->sla->create([
                'name'          => $request->name,
                'description'   => $request->description,
                'target'        => $request->target,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateServiceLevelAgreementRequest $request, $sla)
    {
        try {
            $sla->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'target'        => $request->target,
            ]);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($sla)
    {
        $oldSla = $this->findById($sla);
        $oldSla->delete();
    }
}
