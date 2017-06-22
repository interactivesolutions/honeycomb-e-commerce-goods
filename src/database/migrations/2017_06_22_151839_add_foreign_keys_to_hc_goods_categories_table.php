<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods_categories', function(Blueprint $table)
		{
			$table->foreign('resource_id', 'fk_hcg_categories_hc_resources1')->references('id')->on('hc_resources')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('parent_id', 'fk_hcg_categories_hcg_categories1')->references('id')->on('hc_goods_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods_categories', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_categories_hc_resources1');
			$table->dropForeign('fk_hcg_categories_hcg_categories1');
		});
	}

}
