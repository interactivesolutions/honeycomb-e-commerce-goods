<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECAttributesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_types_attributes_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'description', 'label', 'slug', 'seo_title', 'seo_description', 'seo_keywords'];
}