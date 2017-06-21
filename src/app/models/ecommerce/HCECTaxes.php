<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCECTaxes extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_taxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'value', 'country_id'];

}
