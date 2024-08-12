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
        Schema::create('stock_transations', function (Blueprint $table) {
            $table->id();
            $table->integer('group_no')->default(0);
            $table->string('in_date')->nullable();
            $table->string('in_time')->nullable();
            $table->integer('item_id');
            $table->double('in_qty',11,3)->default(0);
            $table->double('out_qty',11,3)->default(0);
            $table->double('converted_in_qty',11,3)->default(0);
            $table->double('converted_out_qty',11,3)->default(0);
            $table->string('invoice_number')->nullable();
            $table->integer('transaction_id');
            $table->string('transaction_type')->nullable();
            $table->string('description')->nullable();
            $table->integer('user_id')->default(0);
            $table->integer('van_id')->default(0);
            $table->integer('store_id')->default(0);
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
        Schema::dropIfExists('stock_transations');
    }
};
