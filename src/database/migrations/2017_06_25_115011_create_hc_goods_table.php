<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_goods', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->string('id', 36)->unique('id_UNIQUE');
			$table->timestamps();
			$table->softDeletes();
			$table->string('type_id', 36)->index('fk_hcg_hcg_types1_idx');
			$table->boolean('virtual')->nullable();
			$table->string('reference')->nullable();
			$table->integer('ean_13')->nullable();
			$table->float('price', 10, 0);
			$table->string('tax_id', 36)->index('fk_hcg_hcg_taxes1_idx');
			$table->float('price_before_tax', 10, 0);
			$table->string('deposit_id', 36)->nullable()->index('fk_hcg_hcg_deposits1_idx');
			$table->string('country_id', 36)->nullable()->index('fk_hcg_hc_regions_countries1_idx');
			$table->string('gallery_id', 36)->nullable()->index('fk_hcg_hc_galleries_idx');
			$table->string('manufacturer_id', 36)->nullable()->index('fk_hcg_hcg_manufacturers1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_goods');
	}

}
