<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcPricesRulesAffectedItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_prices_rules_affected_items', function(Blueprint $table)
		{
			$table->foreign('rule_id', 'fk_hc_prices_rules_affected_items_hc_price_rules1')->references('id')->on('hc_prices_rules')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_prices_rules_affected_items', function(Blueprint $table)
		{
			$table->dropForeign('fk_hc_prices_rules_affected_items_hc_price_rules1');
		});
	}

}
