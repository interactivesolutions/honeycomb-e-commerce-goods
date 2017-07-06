<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcCarriersDeliveryOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_carriers_delivery_options', function(Blueprint $table)
		{
			$table->foreign('carrier_id', 'fk_hc_carriers_delivery_options_hc_carriers1')->references('id')->on('hc_carriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_carriers_delivery_options', function(Blueprint $table)
		{
			$table->dropForeign('fk_hc_carriers_delivery_options_hc_carriers1');
		});
	}

}
