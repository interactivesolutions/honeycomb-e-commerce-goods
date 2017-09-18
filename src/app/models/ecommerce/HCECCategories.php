<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECPriceRules;

class HCECCategories extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'resource_id', 'parent_id', 'sequence', 'active'];

    /**
     * Get all of the rules for the category.
     */
    public function rules()
    {
        return $this->morphToMany(HCECPriceRules::class, 'rulable', HCECPriceRulesAffectedItems::getTableName(), 'rulable_id', 'rule_id');
    }

    /**
     * Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(HCECTypes::class, 'hc_goods_categories_types', 'goods_category_id', 'goods_type_id');
    }

    /**
     * Parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(HCECCategories::class, 'parent_id', 'id');
    }


    /**
     * Where is active
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('active', '1');
    }

    /**
     * Where is not active
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotActive($query)
    {
        return $query->where('active', '0');
    }
}
