<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsManufacturersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_manufacturers', function(Blueprint $table)
		{
			$table->foreign('logo_id', 'fk_hcg_manufacturers_hc_resources1')->references('id')->on('hc_resources')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_manufacturers', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_manufacturers_hc_resources1');
		});
	}

}
