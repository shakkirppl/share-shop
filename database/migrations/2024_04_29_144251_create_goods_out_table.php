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
        Schema::create('goods_out', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('bill_mode')->nullable();
            $table->string('in_date')->nullable();
            $table->string('in_time')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('delivery_no')->nullable();
            $table->double('other_charge',11,3)->default(0);
            $table->double('discount',11,3)->default(0);
            $table->double('total',11,3)->default(0);
            $table->double('total_tax',11,3)->default(0);
            $table->double('grand_total',11,3)->default(0);
            $table->double('receipt',11,3)->default(0);
            $table->double('balance',11,3)->default(0);
            $table->integer('order_type')->default(1);
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
        Schema::dropIfExists('goods_out');
    }
};
