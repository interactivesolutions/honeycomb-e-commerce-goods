<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\rules\HCECPriceRulesAffectedItems;

class HCECGoods extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'type_id', 'virtual', 'reference', 'ean_13', 'price', 'tax_id', 'price_before_tax', 'deposit_id', 'country_id', 'gallery_id', 'manufacturer_id'];

    /**
     * Get all of the rules for the good.
     *
     * @return mixed
     */
    public function rules()
    {
        return $this->morphMany(HCECPriceRulesAffectedItems::class, 'rulable')->with('rule');
    }

    /**
     * Get all of the categories for the good.
     *
     * @return mixed
     */
    public function categories()
    {
        return $this->morphMany(HCECPriceRulesAffectedItems::class, 'rulable')->with('rule');
    }

    /**
     * Has many combinations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function combinations()
    {
        return $this->hasMany(HCECCombinations::class, 'goods_id');
    }
}
