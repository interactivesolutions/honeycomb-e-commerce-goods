<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\attributes;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECAttributes;

class HCECValues extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_attributes_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'attribute_id'];

    /**
     * Belongs to attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(HCECAttributes::class, 'attribute_id');
    }
}
