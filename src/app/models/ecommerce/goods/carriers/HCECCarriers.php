<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\carriers;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCECCarriers extends HCMultiLanguageModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_carriers';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'resource_id', 'label', 'slug', 'max_package_width','max_package_height','max_package_depth','max_package_weight'];

}
