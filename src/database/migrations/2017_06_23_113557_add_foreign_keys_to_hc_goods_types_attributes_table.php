<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsTypesAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_types_attributes', function(Blueprint $table)
		{
			$table->foreign('type_id', 'fk_hcg_types_attributes_hcg_types1')->references('id')->on('hc_goods_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_types_attributes', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_types_attributes_hcg_types1');
		});
	}

}
