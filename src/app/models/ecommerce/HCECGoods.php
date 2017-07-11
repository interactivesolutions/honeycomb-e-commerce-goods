<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\rules\HCECPriceRulesAffectedItems;
use interactivesolutions\honeycombresources\app\models\HCResources;

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


    /**
     * Relation to product images
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(HCResources::class, 'hc_goods_images', 'goods_id', 'image_id')->withPivot('position')->withTimestamps();
    }

    /**
     * Update product images with related combination images
     *
     * @param array $newImageIds
     */
    public function updateImages(array $newImageIds)
    {
        // trim empty values
        $newImageIds = array_map('trim', $newImageIds);

        // generate thumb images with 85% quality
        $this->generateImageThumbs($newImageIds);

        $currentIds = $this->images()->pluck('id')->all();

        // find array differences
        $imagesToRemove = array_diff($currentIds, $newImageIds);

        if( count($imagesToRemove) ) {
            foreach ( $this->combinations()->get() as $combination ) {
                $combination->images()->detach($imagesToRemove);
            }
        }

        $this->images()->sync($newImageIds);
    }

    /**
     * Generate image thumbs
     *
     * @param array $newImageIds
     */
    protected function generateImageThumbs(array $newImageIds)
    {
//        (new ImageThumbs())->generate(['product-big', 'product-small'], $newImageIds, 85);
    }
}
