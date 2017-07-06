<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\carriers;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECPricesCarriers extends HCUuidModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_prices_carries';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'weight', 'price', 'carrier_id', 'regions_countries_id'];

}
