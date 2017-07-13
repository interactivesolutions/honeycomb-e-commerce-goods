<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;

class HCECDynamicAttributes extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_dynamic_attributes_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'attribute_id', 'value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(HCECGoods::class, 'good_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributes()
    {
        return $this->belongsTo(HCECAttributes::class, 'attribute_id', 'id');
    }
}
