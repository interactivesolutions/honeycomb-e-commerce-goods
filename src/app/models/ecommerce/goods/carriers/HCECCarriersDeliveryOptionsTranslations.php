<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\carriers;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECCarriersDeliveryOptionsTranslations extends HCUuidModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_carriers_delivery_options_translations';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'label', 'description', 'seo_title','seo_description','seo_keywords'];

}
