<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcPricesCarriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_prices_carries', function(Blueprint $table)
		{
			$table->foreign('carrier_id', 'fk_hc_prices_carries_hc_carriers')->references('id')->on('hc_carriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('regions_countries_id', 'fk_hc_prices_carries_hc_regions_countries1')->references('id')->on('hc_regions_countries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_prices_carries', function(Blueprint $table)
		{
			$table->dropForeign('fk_hc_prices_carries_hc_carriers');
			$table->dropForeign('fk_hc_prices_carries_hc_regions_countries1');
		});
	}

}
