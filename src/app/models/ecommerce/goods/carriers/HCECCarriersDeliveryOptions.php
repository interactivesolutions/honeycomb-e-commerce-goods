<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\carriers;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCECCarriersDeliveryOptions extends HCMultiLanguageModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_carriers_delivery_options';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'carrier_id', 'type', 'fixed_price'];

}
