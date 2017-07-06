<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\carriers;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECCarriersTranslations extends HCUuidModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_carriers_translations';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'description', 'seo_title','seo_description','seo_keywords'];

}
