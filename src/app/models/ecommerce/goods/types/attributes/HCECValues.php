<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types\attributes;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCECValues extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_types_attributes_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'attribute_id'];

}
