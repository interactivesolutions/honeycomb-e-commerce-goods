<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResourceIdHcGoodsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_goods_attributes', function (Blueprint $table) {
            $table->string('resource_id', 36)->nullable();

            $table->foreign('resource_id')->on('hc_resources')->references('id')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_goods_attributes', function (Blueprint $table) {
            $table->dropForeign(['resource_id']);

            $table->dropColumn('resource_id');
        });
    }
}
