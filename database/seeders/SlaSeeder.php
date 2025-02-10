<?php

namespace Database\Seeders;

use App\Models\ServiceLevelAgreement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slas = [
            [
                "name"          => "next day",
                "description"   => "mengirim paket dengan waktu pengiriman 1 hari",
                "target"        => 1,
            ],
            [
                "name"          => "regular",
                "description"   => "mengirim paket dengan waktu pengiriman 1-2hari",
                "target"        => 2,
            ],
            [
                "name"          => "Ekonomi",
                "description"   => "mengirim paket dengan waktu pengiriman 1-4 hari",
                "target"        => 4,
            ],
        ];

        foreach ($slas as $sla) {
            ServiceLevelAgreement::create([
                'name' => $sla['name'],
                'description' => $sla['description'],
                'target' => $sla['target'],
            ]);
        }
    }
}
