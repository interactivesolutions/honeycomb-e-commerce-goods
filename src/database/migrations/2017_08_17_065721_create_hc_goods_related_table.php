<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_related', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('goods_id', 36);
            $table->string('related_goods_id', 36);
            $table->integer('sequence')->nullable();

            $table->unique(['goods_id', 'related_goods_id']);

            $table->foreign('goods_id')->references('id')->on('hc_goods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('related_goods_id')->references('id')->on('hc_goods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_goods_related');
    }
}
