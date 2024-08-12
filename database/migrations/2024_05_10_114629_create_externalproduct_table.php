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
        Schema::create('externalproduct', function (Blueprint $table) {
            $table->id();
            $table->string('store_code')->nullable();
            $table->string('code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('tax')->nullable();
            $table->string('base_unit')->nullable();
            $table->string('base_unit_price')->nullable();
            $table->string('base_unit_qty')->default('1');
            $table->string('second_unit')->nullable();
            $table->string('second_unit_price')->nullable();
            $table->string('second_unit_qty')->nullable();
            $table->string('third_unit')->nullable();
            $table->string('third_unit_price')->nullable();
            $table->string('third_unit_qty')->nullable();
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
        Schema::dropIfExists('externalproduct');
    }
};
