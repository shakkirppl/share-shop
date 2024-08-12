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
        Schema::create('invoice_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('bill_type')->nullable();
            $table->string('bill_mode')->nullable();
            $table->integer('bill_no')->default(0);
            $table->string('bill_prefix')->nullable();
            $table->integer('store_id')->default(0);
            $table->integer('financial_year')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_numbers');
    }
};
