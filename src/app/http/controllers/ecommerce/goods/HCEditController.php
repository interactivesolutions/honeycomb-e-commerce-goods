<?php

namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce\goods;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECAttributes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;

class HCEditController extends HCBaseController
{
    /**
     * Returning configured admin view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $good = HCECGoods::findOrFail($id);

        $config = [
            'title'        => trans('HCECommerceGoods::e_commerce_goods_edit.page_title'),
            'structureURL' => route('admin.api.form-manager', ['e-commerce-goods-edit']),
            'newRecordUrl' => 1,
            'contentID'    => $id,
            'attributes'   => $this->getAttributes($good->type_id),
            'combinations' => $this->getCombinations($good->id),
        ];

        return hcview('HCCoreUI::admin.goods.edit', ['config' => $config]);
    }

    /**
     * Get attributes with values
     *
     * @param $typeId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getAttributes($typeId)
    {
        $attributes = HCECAttributes::with([
            'translations' => function ($query) {
                $query->select(['id', 'record_id', 'language_code', 'description', 'label', 'slug']);
            },
            'values'       => function ($query) {
                $query->with(['translations' => function ($query) {
                    $query->select(['id', 'record_id', 'language_code', 'description', 'label', 'slug']);
                }]);
            }])
            ->select(HCECAttributes::getFillableFields())
            ->whereHas('types', function ($query) use ($typeId) {
                $query->where('type_id', $typeId);
            })
            ->notDynamic()
            ->get();

        return $attributes;
    }


    /**
     * Create combination
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate()
    {
        $goodsId = request()->segment(5);

        if( empty(array_values(request()->except('_token'))) ) {
            return redirect()->back();
        }

        $attributeValueIds = array_values(request()->except('_token'));

        if( $this->combinationExists($attributeValueIds, $goodsId) ) {
            return redirect()->route('admin.routes.e.commerce.goods.{_id}.index', [$goodsId, '#combinations']);
        }

        $isDefault = HCECCombinations::where('goods_id', $goodsId)->count() ? "0" : "1";

        $combination = HCECCombinations::create([
            'goods_id'   => $goodsId,
            'is_default' => $isDefault,
        ]);

        $values = $combination->attribute_values()->get();

        if( $values->isEmpty() ) {
            $combination->attribute_values()->sync(array_values(request()->except('_token')));
        }

        return redirect()->route('admin.routes.e.commerce.goods.{_id}.index', [$goodsId, '#combinations']);
    }

    /**
     * Get combinations
     *
     * @param $goodsId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getCombinations($goodsId)
    {
        $combinations = HCECCombinations::with(['attribute_values' => function ($query) {

            $query->join('hc_goods_attributes_values_translations', function ($join) {
                $join->on('hc_goods_attributes_values_translations.record_id', '=', 'hc_goods_attributes_values.id')
                    ->whereNull('hc_goods_attributes_values_translations.deleted_at');
            })->select('hc_goods_attributes_values_translations.label', 'hc_goods_attributes_values.id', 'hc_goods_attributes_values.attribute_id')
                ->whereHas('attribute', function ($query) {
                    $query->where('dynamic', 0);
                })
                ->with(['attribute' => function ($query) {
                    $query->join('hc_goods_attributes_translations', function ($join) {
                        $join->on('hc_goods_attributes_translations.record_id', '=', 'hc_goods_attributes.id')
                            ->whereNull('hc_goods_attributes_translations.deleted_at');
                    })->select('hc_goods_attributes_translations.label', 'hc_goods_attributes.id');
                }]);
        }])
            ->where('goods_id', $goodsId)
            ->get();

        return $combinations;
    }

    /**
     * Delete combination
     *
     * @param $goodsId
     * @param $combinationId
     * @return array
     */
    public function deleteCombination($goodsId, $combinationId)
    {
        $combination = HCECCombinations::where('goods_id', $goodsId)->where('id', $combinationId)->first();
        $combination->attribute_values()->detach();
        $combination->forceDelete();

        return ['success' => true];
    }

    /**
     * Check if combination exists
     *
     * @param $attributeValueIds
     * @param $goodsId
     * @return bool
     */
    private function combinationExists($attributeValueIds, $goodsId)
    {
        $results = (\DB::select("SELECT
 	hgca.attribute_value_id,
  	hgca.goods_combination_id
FROM `hc_goods_combinations_attributes` hgca 
JOIN hc_goods_combinations hgc ON hgc.id = hgca.goods_combination_id and hgc.goods_id = :goods_id
JOIN hc_goods_attributes_values hgav ON hgav.id = hgca.attribute_value_id
JOIN hc_goods_attributes ha ON ha.id = hgav .attribute_id
GROUP BY
  	hgav.attribute_id,
    hgca.goods_combination_id,
    hgca.attribute_value_id", ['goods_id' => $goodsId]));

        foreach ( collect($results)->groupBy('goods_combination_id') as $combination => $items ) {
            if( $items->pluck('attribute_value_id')->diff($attributeValueIds)->isEmpty() ) {
                return true;
            }
        }

        return false;
    }
}
