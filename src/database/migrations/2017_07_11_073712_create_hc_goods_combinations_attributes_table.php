<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsCombinationsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_combinations_attributes', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('goods_combination_id', 36);
            $table->string('attribute_value_id', 36);

            $table->unique(['goods_combination_id', 'attribute_value_id'], 'combination_attribute_value_unique');

            $table->foreign('goods_combination_id')->references('id')->on('hc_goods_combinations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('attribute_value_id')->references('id')->on('hc_goods_types_attributes_values')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_goods_combinations_attributes');
    }
}
