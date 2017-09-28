<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreOrderFieldsToHcGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_goods', function (Blueprint $table) {
            $table->enum('allow_pre_order', ['0', '1'])->nullable()->default('0');
            $table->integer('pre_order_count')->unsigned()->nullable();
            $table->integer('pre_order_days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_goods', function (Blueprint $table) {
            $table->dropColumn('allow_pre_order', 'pre_order_count', 'pre_order_days');
        });
    }
}
