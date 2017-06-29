<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\rules;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;

class HCECPriceRules extends HCUuidModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_price_rules';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'name', 'from', 'to', 'type', 'amount'];

    /**
     * Get all of the goods that are assigned this rule.
     */
    public function goods()
    {
        return $this->morphedByMany(HCECGoods::class, 'rulable')->where('rule_id', $this->id);
    }

    /**
     * Get all of the categories that are assigned this rule.
     */
    public function categories()
    {
        return $this->morphedByMany(HCECCategories::class, 'rulable')->where('rule_id', $this->id);
    }
}
