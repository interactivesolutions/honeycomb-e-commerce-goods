<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsManufacturersTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_manufacturers_translations', function(Blueprint $table)
		{
			$table->foreign('language_code', 'fk_hcg_manufacturers_translations_hc_languages1')->references('iso_639_1')->on('hc_languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('record_id', 'fk_hcg_manufacturers_translations_hcg_manufacturers1')->references('id')->on('hc_goods_manufacturers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_manufacturers_translations', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_manufacturers_translations_hc_languages1');
			$table->dropForeign('fk_hcg_manufacturers_translations_hcg_manufacturers1');
		});
	}

}
