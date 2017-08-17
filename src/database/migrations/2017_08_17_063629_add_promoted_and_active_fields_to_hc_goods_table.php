<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPromotedAndActiveFieldsToHcGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_goods', function (Blueprint $table) {
            $table->enum('active', ['0', '1'])->default('1');
            $table->enum('promoted', ['0', '1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_goods', function (Blueprint $table) {
            $table->dropColumn('active', 'promoted');
        });
    }
}
