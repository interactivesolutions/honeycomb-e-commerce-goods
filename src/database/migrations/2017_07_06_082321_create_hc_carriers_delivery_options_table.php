<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcCarriersDeliveryOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_carriers_delivery_options', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->string('id', 36)->unique('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('carrier_id', 36)->index('fk_hc_carriers_delivery_options_hc_carriers1_idx');
			$table->enum('type', array('self collected','delivery','digital'));
			$table->float('fixed_price', 10, 0)->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_carriers_delivery_options');
	}

}
