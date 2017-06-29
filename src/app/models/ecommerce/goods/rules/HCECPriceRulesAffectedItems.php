<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\rules;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECPriceRulesAffectedItems extends HCUuidModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'hc_prices_rules_affected_items';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'rule_id', 'rulable_type', 'rulable_id'];

    /**
     * Get rule.
     */
    public function rule ()
    {
        return $this->hasOne(HCECPriceRules::class, 'id', 'rule_id');
    }
}
