<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceTaxAmountFieldToHcGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_goods', function (Blueprint $table) {
            $table->float('price_tax_amount', 20, 6)->after('price_before_tax')->default(0.000000);
        });

        \DB::statement("ALTER TABLE `hc_goods` CHANGE `price` `price` DOUBLE(20,6) NOT NULL DEFAULT '0.000000';");
        \DB::statement("ALTER TABLE `hc_goods` CHANGE `price_before_tax` `price_before_tax` DOUBLE(20,6) NOT NULL DEFAULT '0.000000';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("ALTER TABLE `hc_goods` CHANGE `price` `price` DOUBLE NOT NULL;");
        \DB::statement("ALTER TABLE `hc_goods` CHANGE `price_before_tax` `price_before_tax` DOUBLE NOT NULL;");

        Schema::table('hc_goods', function (Blueprint $table) {
            $table->dropColumn('price_tax_amount');
        });
    }
}
