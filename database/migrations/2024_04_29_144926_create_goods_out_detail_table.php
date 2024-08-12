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
        Schema::create('goods_out_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('goods_out_id');
            $table->integer('item_id');
            $table->double('quantity',11,3)->default(0);
            $table->double('rate',11,3)->default(0);
            $table->double('prodiscount',11,3)->default(0);
            $table->double('taxable',11,3)->default(0);
            $table->double('tax_amt',11,3)->default(0);
            $table->double('mrp',11,3)->default(0);
            $table->double('amount',11,3)->default(0);
            $table->integer('store_id')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_out_detail');
    }
};
