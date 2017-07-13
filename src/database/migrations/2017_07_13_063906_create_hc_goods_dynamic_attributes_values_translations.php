<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcGoodsDynamicAttributesValuesTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_dynamic_attributes_values_translations', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('record_id', 36);
            $table->string('language_code', 2);

            $table->string('value', 255)->nullable();
            $table->unique(['record_id','language_code'], 'record_language_unique');

            $table->foreign('record_id', 'fk_dyn_val_dyn_val_trans')->references('id')->on('hc_goods_dynamic_attributes_values')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('language_code', 'fk_dyn_val_lang')->references('iso_639_1')->on('hc_languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_goods_dynamic_attributes_values_translations');
    }
}
