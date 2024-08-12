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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pro_image')->nullable();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('tax_id');
            $table->double('tax_percentage')->default(0);
            $table->integer('tax_inclusive')->default(1);
            $table->double('price',11,2)->default(0);
            $table->string('description')->nullable();
            $table->double('product_qty',11,2)->default(0);
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
        Schema::dropIfExists('products');
    }
};
