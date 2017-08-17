<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCECGoodsRelated extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_related';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'related_goods_id'];

    /**
     * Belongs to goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(HCECGoods::class, 'goods_id', 'id');
    }

    /**
     * Belongs to goods
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function related_goods()
    {
        return $this->belongsTo(HCECGoods::class, 'related_goods_id', 'id');
    }
}
