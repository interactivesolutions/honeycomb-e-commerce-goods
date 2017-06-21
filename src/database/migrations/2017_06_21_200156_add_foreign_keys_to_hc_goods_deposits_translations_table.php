<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsDepositsTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_deposits_translations', function(Blueprint $table)
		{
			$table->foreign('record_id', 'fk_hcg_deposits_translations_hcg_deposits1')->references('id')->on('hc_goods_deposits')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('language_code', 'fk_hcg_types_attributes_translations_hc_languages1000')->references('iso_639_1')->on('hc_languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_deposits_translations', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_deposits_translations_hcg_deposits1');
			$table->dropForeign('fk_hcg_types_attributes_translations_hc_languages1000');
		});
	}

}
