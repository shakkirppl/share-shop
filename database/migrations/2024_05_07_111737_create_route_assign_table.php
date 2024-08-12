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
        Schema::create('route_assign', function (Blueprint $table) {
            $table->id();
            $table->integer('route_id');
            $table->integer('van_id');
            $table->integer('user_id');
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('route_assign');
    }
};
