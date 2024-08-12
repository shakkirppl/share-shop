<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_type')->insert([
            'name' => 'Dine In'
        ]);
        DB::table('order_type')->insert([
            'name' => 'Take Away'
        ]);
        DB::table('order_type')->insert([
            'name' => 'Delivery'
        ]);
    }
}
