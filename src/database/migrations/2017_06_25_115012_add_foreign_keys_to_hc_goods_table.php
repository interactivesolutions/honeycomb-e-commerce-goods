<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_goods', function(Blueprint $table)
		{
			$table->foreign('gallery_id', 'fk_hcg_hc_galleries')->references('id')->on('hc_galleries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('country_id', 'fk_hcg_hc_regions_countries1')->references('id')->on('hc_regions_countries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('deposit_id', 'fk_hcg_hcg_deposits1')->references('id')->on('hc_goods_deposits')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('manufacturer_id', 'fk_hcg_hcg_manufacturers1')->references('id')->on('hc_goods_manufacturers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tax_id', 'fk_hcg_hcg_taxes1')->references('id')->on('hc_goods_taxes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('type_id', 'fk_hcg_hcg_types1')->references('id')->on('hc_goods_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_goods', function(Blueprint $table)
		{
			$table->dropForeign('fk_hcg_hc_galleries');
			$table->dropForeign('fk_hcg_hc_regions_countries1');
			$table->dropForeign('fk_hcg_hcg_deposits1');
			$table->dropForeign('fk_hcg_hcg_manufacturers1');
			$table->dropForeign('fk_hcg_hcg_taxes1');
			$table->dropForeign('fk_hcg_hcg_types1');
		});
	}

}
