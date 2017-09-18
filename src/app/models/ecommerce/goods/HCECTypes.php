<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECPriceRules;

class HCECTypes extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'active', 'sequence'];

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
    public function categories()
    {
        return $this->belongsToMany(HCECCategories::class, 'hc_goods_categories_types', 'goods_type_id', 'goods_category_id');
    }

    /**
     * @param array $categories
     */
    public function updateCategories(array $categories)
    {
        $this->categories()->sync($categories);
    }

    /**
     * Relation to goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(HCECGoods::class, 'type_id', 'id');
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
