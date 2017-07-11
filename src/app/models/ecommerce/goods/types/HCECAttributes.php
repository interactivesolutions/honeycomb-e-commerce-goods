<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types\attributes\HCECValues;

class HCECAttributes extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_types_attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'dynamic', 'min_select', 'max_select', 'multilanguage', 'type_id'];

    /**
     * Values
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(HCECValues::class, 'attribute_id');
    }
}
