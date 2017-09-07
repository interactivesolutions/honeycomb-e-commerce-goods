<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSequenceAndActiveFieldToHcGoodsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_goods_categories', function (Blueprint $table) {
            $table->integer('sequence')->default(0)->nullable();
            $table->enum('active', ['0', '1'])->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_goods_categories', function (Blueprint $table) {
            $table->dropColumn('sequence', 'active');
        });
    }
}
