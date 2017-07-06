<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcCarriersCollectAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_carriers_collect_addresses', function(Blueprint $table)
		{
			$table->foreign('delivery_option_id', 'fk_hc_carriers_collect_addresses_hc_carriers_delivery_options1')->references('id')->on('hc_carriers_delivery_options')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_carriers_collect_addresses', function(Blueprint $table)
		{
			$table->dropForeign('fk_hc_carriers_collect_addresses_hc_carriers_delivery_options1');
		});
	}

}
