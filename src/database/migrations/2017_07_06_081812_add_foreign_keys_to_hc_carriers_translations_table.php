<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcCarriersTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_carriers_translations', function(Blueprint $table)
		{
			$table->foreign('record_id', 'fk_hc_carriers_translations_hc_carriers1')->references('id')->on('hc_carriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('language_code', 'fk_hc_carriers_translations_hc_languages1')->references('iso_639_1')->on('hc_languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_carriers_translations', function(Blueprint $table)
		{
			$table->dropForeign('fk_hc_carriers_translations_hc_carriers1');
			$table->dropForeign('fk_hc_carriers_translations_hc_languages1');
		});
	}

}
