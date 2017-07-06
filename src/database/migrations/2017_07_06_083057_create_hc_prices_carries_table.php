<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcPricesCarriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_prices_carries', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->string('id', 36)->unique('id_UNIQUE');
			$table->timestamps();
			$table->softDeletes();
			$table->float('weight', 10, 0)->unsigned();
			$table->float('price', 10, 0)->unsigned();
			$table->string('carrier_id', 36)->index('fk_hc_prices_carries_hc_carriers_idx');
			$table->string('regions_countries_id', 36)->index('fk_hc_prices_carries_hc_regions_countries1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_prices_carries');
	}

}
