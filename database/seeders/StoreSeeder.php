<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            ['area_code' => 'hokkaido', 'name' => 'ケーズデンキ札幌本店', 'code' => 'ks_sapporo'],
            ['area_code' => 'hokkaido', 'name' => 'ヤマダデンキ札幌店', 'code' => 'ymd_sapporo'],
            ['area_code' => 'shutoken', 'name' => 'ヨドバシAkiba', 'code' => 'yodobashi_akiba'],
        ];

        foreach ($stores as $store) {
            $area = Area::where('code', $store['area_code'])->first();

            if (!$area) {
                continue;
            }

            Store::updateOrCreate(
                ['code' => $store['code']],
                [
                    'area_id' => $area->id,
                    'name' => $store['name'],
                    'is_active' => true,
                ]
            );
        }
    }
}
