<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcCarriersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_carriers', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->string('id', 36)->unique('id_UNIQUE');
			$table->timestamps();
			$table->softDeletes();
			$table->string('resource_id', 36)->nullable()->index('fk_hc_carriers_hc_resources1_idx');
			$table->string('label');
			$table->string('slug');
			$table->float('max_package_width', 10, 0)->unsigned()->nullable();
			$table->float('max_package_height', 10, 0)->unsigned()->nullable();
			$table->float('max_package_depth', 10, 0)->unsigned()->nullable();
			$table->float('max_package_weight', 10, 0)->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_carriers');
	}

}
