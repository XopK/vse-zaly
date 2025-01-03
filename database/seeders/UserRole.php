<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['title_role' => 'Пользователь'],
            ['title_role' => 'Партнёр'],
            ['title_role' => 'Администратор'],
            ['title_role' => 'Сотрудник студии']
        ]);
    }
}
