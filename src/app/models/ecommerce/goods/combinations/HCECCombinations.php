<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\attributes\HCECValues;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECSpecificPrice;
use interactivesolutions\honeycombresources\app\models\HCResources;

class HCECCombinations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_combinations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'is_default', 'goods_id', 'code_reference', 'code_ean13', 'code_upc', 'price_action', 'price_impact', 'price_tax_excluded', 'price_tax_included', 'price_tax_amount'];

    /**
     * Related to goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(HCECGoods::class, 'goods_id');
    }

    /**
     * Has many attribute values
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attribute_values()
    {
        return $this->belongsToMany(HCECValues::class, 'hc_goods_combinations_attributes', 'goods_combination_id', 'attribute_value_id')->withTimestamps();
    }

    /**
     * Relation to goods combination images
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(HCResources::class, 'hc_goods_combinations_images', 'goods_combination_id', 'image_id')->withPivot('position')->withTimestamps();
    }

    /**
     * Specific price
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function specific_price()
    {
        return $this->hasOne(HCECSpecificPrice::class, 'combination_id', 'id');
    }

    /**
     * Update images
     *
     * @param array $images
     */
    public function updateImages(array $images)
    {
        $this->images()->sync($images);
    }

    /**
     * Update specific price
     *
     * @param array $data
     * @param $priceAction
     */
    public function updateSpecificPrice(array $data, $priceAction)
    {
        $specific = $this->specific_price()->first();

        if( $priceAction != 'specific' && ! is_null($specific) ) {
            $specific->forceDelete();
        } else if( $priceAction == 'specific' ) {

            if( is_null($specific) ) {
                $this->specific_price()->create($data);
            } else {
                $this->specific_price()->update($data);
            }
        }
    }

}
