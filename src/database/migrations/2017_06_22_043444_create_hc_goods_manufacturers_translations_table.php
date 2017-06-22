<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcGoodsManufacturersTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_goods_manufacturers_translations', function(Blueprint $table)
		{
			$table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();
			$table->string('record_id', 36)->index('fk_hcg_manufacturers_translations_hcg_manufacture_idx');
			$table->string('language_code', 2)->index('fk_hcg_manufacturers_translations_hc_languages1_idx');
			$table->text('description', 65535)->nullable();
			$table->string('seo_title')->nullable();
			$table->string('seo_description')->nullable();
			$table->string('seo_keywords')->nullable();
			$table->unique(['record_id','language_code'], 'fk_hcg_manufacturers_translations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_goods_manufacturers_translations');
	}

}
