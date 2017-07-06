<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\carriers;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECCarriersCollectAddresses extends HCUuidModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_carriers_collect_addresses';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'delivery_option_id', 'name', 'address'];

}
