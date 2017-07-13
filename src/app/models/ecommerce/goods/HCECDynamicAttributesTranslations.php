<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECDynamicAttributesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_dynamic_attributes_values_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'value'];
}