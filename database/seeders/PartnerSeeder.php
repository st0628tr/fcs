<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [

            [
                'name' => 'ForceLinkNext株式会社',
                'code' => 'force',
            ],

            [
                'name' => 'ライクスタッフィング株式会社',
                'code' => 'like',
            ],

            [
                'name' => '株式会社ヒト・コミュニケーションズ',
                'code' => 'hitocom',
            ],

        ];

        foreach ($partners as $partner) {

            Partner::updateOrCreate(

                ['code' => $partner['code']],

                [
                    'name' => $partner['name'],
                    'is_active' => true,
                ]

            );

        }
    }
}
