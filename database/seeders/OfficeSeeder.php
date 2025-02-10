<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::factory()->kcu()->create();

        // Create three KC offices, each with the KCU as parent
        $kcs = Office::factory()->count(3)->kc()->create();

        // Create nine KCP offices, each with one of the KCs as parent
        foreach ($kcs as $kc) {
            Office::factory()->count(3)->kcp()->create(['parent_id' => $kc->id]);
        }
    }
}
