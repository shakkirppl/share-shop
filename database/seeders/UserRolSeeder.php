<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_rol')->insert([
            'name' => 'Admin'
        ]);
        DB::table('user_rol')->insert([
            'name' => 'Sales'
        ]);
        DB::table('user_rol')->insert([
            'name' => 'Store'
        ]);
    }
}
