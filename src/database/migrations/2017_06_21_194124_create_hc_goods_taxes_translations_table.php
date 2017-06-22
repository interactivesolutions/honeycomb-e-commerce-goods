<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcGoodsTaxesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_goods_taxes_translations', function(Blueprint $table)
		{
			$table->integer('count', true);
            $table->timestamps();
            $table->softDeletes();
			$table->string('record_id', 36)->index('fk_hcg_taxes_translations_hcg_taxes1_idx');
			$table->string('language_code', 2)->index('fk_hcg_types_attributes_translations_hc_languages1_idx');
			$table->text('description', 65535)->nullable();
			$table->string('label');
			$table->unique(['record_id','language_code'], 'fk_hcg_taxes_translations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_goods_taxes_translations');
	}

}
