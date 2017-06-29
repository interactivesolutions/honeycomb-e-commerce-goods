<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcPricesRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_prices_rules', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->string('id', 36)->unique('id_UNIQUE');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->dateTime('from');
			$table->dateTime('to');
			$table->enum('type', array('percentage','fixed','final'));
			$table->float('amount', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_prices_rules');
	}

}
