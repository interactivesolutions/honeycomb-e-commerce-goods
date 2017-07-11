<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_images', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('image_id', '36');
            $table->string('goods_id', 36);
            $table->integer('position')->nullable();

            $table->foreign('image_id')->references('id')->on('hc_resources')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('goods_id')->references('id')->on('hc_goods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_goods_images');
    }
}
