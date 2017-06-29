<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcPricesRulesAffectedItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_prices_rules_affected_items', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->string('id', 36)->unique('id_UNIQUE');
			$table->timestamps();
			$table->softDeletes();
			$table->string('rule_id', 36)->index('fk_hc_prices_rules_affected_items_hc_prices_rules1_idx');
			$table->string('rulable_type');
			$table->string('rulable_id', 36);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_prices_rules_affected_items');
	}

}
