<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcGoodsCategoriesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_goods_categories_translations', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('record_id', 36)->index('fk_hcg_categories_translations_hcg_categories1_idx');
			$table->string('language_code', 2)->index('fk_hcg_categories_translations_hc_languages1_idx');
			$table->text('description', 65535)->nullable();
			$table->string('label');
			$table->string('slug');
			$table->string('seo_title')->nullable();
			$table->string('seo_description')->nullable();
			$table->string('seo_keywords')->nullable();
			$table->unique(['record_id','language_code'], 'fk_hcg_categories_translations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_goods_categories_translations');
	}

}
