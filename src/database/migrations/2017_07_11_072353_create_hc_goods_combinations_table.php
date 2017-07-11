<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_combinations', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->enum('is_default', ['0', '1'])->default(0);
            $table->string('goods_id', 36);
            $table->string('code_reference', 60)->unique()->nullable();
            $table->string('code_ean13', 13)->unique()->nullable();
            $table->string('code_upc', 12)->nullable();

            $table->enum('price_action', ['specific', 'impact'])->nullable();
            $table->enum('price_impact', ['1', '-1'])->nullable();

            $table->decimal('price_tax_excluded', 20, 6)->default('0.000000');
            $table->decimal('price_tax_included', 20, 6)->default('0.000000');
            $table->decimal('price_tax_amount', 20, 6)->default('0.000000');

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
        Schema::dropIfExists('hc_goods_combinations');
    }
}
