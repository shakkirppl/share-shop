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
        Schema::table('products', function (Blueprint $table) {
            //
            $table->integer('base_unit_id')->after('price');
            $table->integer('base_unit_qty')->default(1)->after('base_unit_id');
            $table->decimal('base_unit_discount',11,2)->default(0)->after('base_unit_qty');
            $table->integer('base_unit_op_stock')->default(0)->after('base_unit_discount');
            $table->decimal('second_unit_price',11,2)->default(0)->after('base_unit_op_stock');
            $table->integer('second_unit_id')->default(0)->after('second_unit_price');
            $table->integer('second_unit_qty')->default(0)->after('second_unit_id');
            $table->decimal('second_unit_discount',11,2)->default(0)->after('second_unit_qty');
            $table->decimal('second_unit_op_stock',11,2)->default(0)->after('second_unit_discount');
            $table->decimal('third_unit_price',11,2)->default(0)->after('second_unit_op_stock');
            $table->integer('third_unit_id')->default(0)->after('third_unit_price');
            $table->integer('third_unit_qty')->default(1)->after('third_unit_id');
            $table->decimal('third_unit_discount',11,2)->default(0)->after('third_unit_qty');
            $table->decimal('third_unit_op_stock',11,2)->default(0)->after('third_unit_discount');
            $table->decimal('fourth_unit_price',11,2)->default(0)->after('third_unit_op_stock');
            $table->integer('fourth_unit_id')->default(0)->after('fourth_unit_price');
            $table->integer('fourth_unit_qty')->default(0)->default(1)->after('fourth_unit_id');
            $table->decimal('fourth_unit_discount',11,2)->default(0)->after('fourth_unit_qty');
            $table->decimal('fourth_unit_op_stock',11,2)->default(0)->after('fourth_unit_discount');
            $table->integer('is_multiple_unit')->default(0)->after('fourth_unit_op_stock');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
