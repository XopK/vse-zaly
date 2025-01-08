<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class features extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            ['title_feature' => 'Wi-Fi', 'photo_feature' => 'wifi.png'],
            ['title_feature' => 'Кофе', 'photo_feature' => 'coffe.png'],
            ['title_feature' => 'Мини бар', 'photo_feature' => 'bar.png'],
            ['title_feature' => 'Зеркала', 'photo_feature' => 'mirror.png'],
        ]);
    }
}
