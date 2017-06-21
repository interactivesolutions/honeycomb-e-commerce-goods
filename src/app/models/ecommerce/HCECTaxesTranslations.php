<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCTranslationsModel;

class HCECTaxesTranslations extends HCTranslationsModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_taxes_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['record_id', 'language_code', 'description', 'label'];
}