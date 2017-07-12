<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsAttributesValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_attributes_values', function(Blueprint $table)
		{
			$table->foreign('attribute_id', 'fk_hcg_attributes_values_hcg_ta1')->references('id')->on('hc_goods_attributes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_attributes_values', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_attributes_values_hcg_ta1');
		});
	}

}
