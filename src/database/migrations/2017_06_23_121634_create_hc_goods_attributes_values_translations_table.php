<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcGoodsAttributesValuesTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_goods_attributes_values_translations', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();
            $table->string('record_id', 36)->index('fk_hcg_attributes_values_translations_hcg_ty_idx');
            $table->string('language_code', 2)->index('fk_hcg_attributes_values_translations_hc_language_idx');
            $table->text('description', 65535)->nullable();
            $table->string('label');
            $table->string('slug');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->unique(['record_id', 'language_code'], 'fk_hcg_attributes_translations_unique');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hc_goods_attributes_values_translations');
    }

}
