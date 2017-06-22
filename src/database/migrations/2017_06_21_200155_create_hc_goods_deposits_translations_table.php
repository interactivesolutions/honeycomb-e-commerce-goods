<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcGoodsDepositsTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_goods_deposits_translations', function(Blueprint $table)
		{
			$table->integer('count', true);
            $table->timestamps();
            $table->softDeletes();
			$table->string('record_id', 36)->index('fk_hcg_deposits_translations_hcg_deposits1_idx');
			$table->string('language_code', 2)->index('fk_hcg_types_attributes_translations_hc_languages1_idx');
			$table->string('description')->nullable();
			$table->string('label');
			$table->unique(['record_id','language_code'], 'fk_hcg_deposits_translations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_goods_deposits_translations');
	}

}
