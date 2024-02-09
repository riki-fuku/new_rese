<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_areas')->insert([
            ['id' => 1, 'area_name' => '北海道', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'area_name' => '青森県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'area_name' => '岩手県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'area_name' => '宮城県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'area_name' => '秋田県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'area_name' => '山形県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'area_name' => '福島県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'area_name' => '茨城県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'area_name' => '栃木県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'area_name' => '群馬県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'area_name' => '埼玉県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'area_name' => '千葉県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'area_name' => '東京都', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'area_name' => '神奈川県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'area_name' => '新潟県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'area_name' => '富山県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'area_name' => '石川県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'area_name' => '福井県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'area_name' => '山梨県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'area_name' => '長野県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'area_name' => '岐阜県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'area_name' => '静岡県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'area_name' => '愛知県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'area_name' => '三重県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'area_name' => '滋賀県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'area_name' => '京都府', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'area_name' => '大阪府', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 28, 'area_name' => '兵庫県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 29, 'area_name' => '奈良県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 30, 'area_name' => '和歌山県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 31, 'area_name' => '鳥取県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'area_name' => '島根県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 33, 'area_name' => '岡山県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 34, 'area_name' => '広島県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 35, 'area_name' => '山口県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 36, 'area_name' => '徳島県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 37, 'area_name' => '香川県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 38, 'area_name' => '愛媛県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 39, 'area_name' => '高知県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 40, 'area_name' => '福岡県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 41, 'area_name' => '佐賀県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 42, 'area_name' => '長崎県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 43, 'area_name' => '熊本県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 44, 'area_name' => '大分県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 45, 'area_name' => '宮崎県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 46, 'area_name' => '鹿児島県', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 47, 'area_name' => '沖縄県', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
