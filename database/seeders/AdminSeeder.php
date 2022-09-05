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
        DB::table('admin_list')->insert([
            'admin_id' => '0',
            'admin_username' => 'admin',
            'admin_password' => 'admin',
            'admin_role' => '0',
            'admin_name' => 'Admin Safar',
            'admin_email' => 'admin@gmail.com.my'
        ]);

    }
}
