<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsTypesAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_types_attributes', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('type_id', 36);
            $table->string('attribute_id', 36);

            $table->unique(['type_id', 'attribute_id']);
            $table->foreign('type_id')->references('id')->on('hc_goods_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('attribute_id')->references('id')->on('hc_goods_attributes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_goods_types_attributes');
    }
}
