<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_out_detail', function (Blueprint $table) {
            //
            $table->integer('unit')->default(0)->after('item_id');
            $table->integer('convert_qty')->default(0)->after('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_out_detail', function (Blueprint $table) {
            //
        });
    }
};
