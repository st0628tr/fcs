<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            ['name' => '北海道', 'code' => 'hokkaido'],
            ['name' => '東北', 'code' => 'tohoku'],
            ['name' => '関信越', 'code' => 'kanshinetsu'],
            ['name' => '首都圏', 'code' => 'shutoken'],
            ['name' => '関西', 'code' => 'kansai'],
            ['name' => '中国', 'code' => 'chugoku'],
            ['name' => '九州', 'code' => 'kyushu'],
        ];

        foreach ($areas as $area) {
            Area::updateOrCreate(
                ['code' => $area['code']],
                ['name' => $area['name']]
            );
        }
    }
}
