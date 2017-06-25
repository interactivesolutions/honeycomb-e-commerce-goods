<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types\attributes;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECValuesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_types_attributes_values_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'description', 'label', 'slug', 'seo_title', 'seo_description', 'seo_keywords'];
}