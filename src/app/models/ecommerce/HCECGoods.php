<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECPriceRules;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECPriceRulesAffectedItems;
use interactivesolutions\honeycombecommercewarehouse\app\models\ecommerce\warehouses\stock\HCECStockSummary;
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
    protected $fillable = ['id', 'active', 'promoted', 'type_id', 'virtual', 'reference', 'ean_13', 'price', 'tax_id', 'price_before_tax', 'price_tax_amount', 'deposit_id', 'country_id', 'gallery_id', 'manufacturer_id', 'allow_pre_order', 'pre_order_count', 'pre_order_days'];

    /**
     * Get all of the rules for the goods.
     */
    public function rules()
    {
        return $this->morphToMany(HCECPriceRules::class, 'rulable', HCECPriceRulesAffectedItems::getTableName(), 'rulable_id', 'rule_id')->isActiveRule();
    }

    /**
     * Belongs to type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(HCECTypes::class, 'type_id', 'id');
    }

    /**
     * Belongs to tax
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax()
    {
        return $this->belongsTo(HCECTaxes::class, 'tax_id', 'id');
    }

    /**
     * Belongs to manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer()
    {
        return $this->belongsTo(HCECManufacturers::class, 'manufacturer_id', 'id');
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
     * Related goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function related()
    {
        return $this->belongsToMany(HCECGoods::class, HCECGoodsRelated::getTableName(), 'goods_id', 'related_goods_id')
            ->withTimestamps()
            ->withPivot('sequence')
            ->orderBy( HCECGoodsRelated::getTableName() . '.sequence');
    }

    /**
     * Belongs to manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock_summary()
    {
        return $this->hasOne(HCECStockSummary::class, 'good_id', 'id');
    }

    /**
     * Active scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('active', '1');
    }

    /**
     * Update product images with related combination images
     *
     * @param array $newImages
     */
    public function updateImages(array $newImages)
    {
        // trim empty values
        $newImageIds = [];

        $i = 0;
        foreach ( $newImages as $newImage ) {
            if( ! $newImage ) {
                continue;
            }

            $newImageIds[$newImage] = [
                'position' => $i++,
            ];
        }

        // generate thumb images with 85% quality
        $this->generateImageThumbs($newImageIds);

        $currentIds = $this->images()->pluck('id', 'position')->all();

        // find array differences
        $imagesToRemove = array_diff($currentIds, array_keys($newImageIds));

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

    /**
     * Update related goods
     *
     * @param array $relatedGoods
     */
    public function updateRelatedGoods(array $relatedGoods)
    {
        $related = [];

        $this->related()->detach();

        $i = 0;

        foreach ( $relatedGoods as $relatedGood ) {

            if( $this->id == $relatedGood ) {
                continue;
            }

            $related[$relatedGood] = [
                'id'       => uuid4(true),
                'sequence' => $i++,
            ];
        }

        if( $related ) {
            $this->related()->sync($related);
        }
    }
}
