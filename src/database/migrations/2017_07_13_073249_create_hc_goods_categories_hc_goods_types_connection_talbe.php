<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsCategoriesHcGoodsTypesConnectionTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_categories_types', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('goods_category_id', 36);
            $table->string('goods_type_id', 36);
            $table->integer('position')->nullable();

            $table->unique(['goods_category_id', 'goods_type_id']);

            $table->foreign('goods_category_id')->references('id')->on('hc_goods_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('goods_type_id')->references('id')->on('hc_goods_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_goods_categories_types');
    }
}
