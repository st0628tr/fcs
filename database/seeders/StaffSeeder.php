<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Staff;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $force = Partner::where('code', 'force')->first();
        $like = Partner::where('code', 'like')->first();

        $sapporo = Store::where('code', 'ks_sapporo')->first();
        $akiba = Store::where('code', 'yodobashi_akiba')->first();

        if (!$force || !$like) {
            return;
        }

        Staff::updateOrCreate(
            ['email' => 'taro@example.com'],
            [
                'partner_id' => $force->id,
                'store_id' => $sapporo?->id,
                'name' => '山田 太郎',
                'kana' => 'ヤマダ タロウ',
                'phone' => '090-0000-0001',
                'employment_type' => 'contract',
                'is_active' => true,
            ]
        );

        Staff::updateOrCreate(
            ['email' => 'jiro@example.com'],
            [
                'partner_id' => $like->id,
                'store_id' => $akiba?->id,
                'name' => '佐藤 次郎',
                'kana' => 'サトウ ジロウ',
                'phone' => '090-0000-0002',
                'employment_type' => 'outsource',
                'is_active' => true,
            ]
        );
    }
}
