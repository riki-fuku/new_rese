<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_genres')->insert([
            ['id' => 1, 'genre_name' => '寿司', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'genre_name' => '焼肉', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'genre_name' => '居酒屋', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'genre_name' => 'イタリアン', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'genre_name' => 'ラーメン', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
