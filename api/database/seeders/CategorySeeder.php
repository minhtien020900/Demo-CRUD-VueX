<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('category')->insert([
                'name' => Str::random(10),
                'image' => 'upload/1617679351.png',
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('category')->insert([
                'name' => 'oppo'.Str::random(2),
                'image' => 'upload/1617681473.png',
            ]);
        }
    }
}
