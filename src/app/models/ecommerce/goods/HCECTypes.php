<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;

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
    protected $fillable = ['id'];

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

}
