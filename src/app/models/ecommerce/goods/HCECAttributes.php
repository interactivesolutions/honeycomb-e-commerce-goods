<?php

namespace interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\attributes\HCECValues;

class HCECAttributes extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_goods_attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'dynamic', 'min_select', 'max_select', 'multilanguage', 'is_boolean'];

    /**
     * Values
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(HCECValues::class, 'attribute_id');
    }

    /**
     * Relation to types
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(HCECTypes::class, 'hc_goods_types_attributes', 'attribute_id', 'type_id')->withTimestamps();
    }

    /**
     * Update types
     *
     * @param array $types
     * @return array
     */
    public function updateTypes(array $types)
    {
        return $this->types()->sync($types);
    }

    /**
     * Not dynamic scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotDynamic($query)
    {
        return $query->where(function ($query) {
            $query->where('dynamic', 0)->orWhereNull('dynamic');
        });
    }

    /**
     * Dynamic scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsDynamic($query)
    {
        return $query->where('dynamic', 1);
    }
}
