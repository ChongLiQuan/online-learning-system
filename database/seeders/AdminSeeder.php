<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adminUser')->insert([
            'id' => '0',
            'username' => 'admin',
            'password' => 'admin',
            'role' => '0',
            'name' => 'Admin Safar',
            'email' => 'admin@gmail.com.my'
        ]);

    }
}