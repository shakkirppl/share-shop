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
        Schema::create('externalcustomer', function (Blueprint $table) {
            $table->id();
            $table->string('store_code')->nullable();
            $table->string('code')->nullable();
            $table->string('erp_code')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('emirates')->nullable();
            $table->string('country')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('trn')->nullable();
            $table->string('bill_type')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('credit_days')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('externalcustomer');
    }
};
