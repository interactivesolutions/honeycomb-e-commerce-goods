<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsDepositsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_deposits', function(Blueprint $table)
		{
			$table->foreign('country_id', 'fk_hcg_deposits_hc_regions_countries1')->references('id')->on('hc_regions_countries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_deposits', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_deposits_hc_regions_countries1');
		});
	}

}
