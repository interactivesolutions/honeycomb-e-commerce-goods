<?php

namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce\goods;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\helpers\PriceHelper;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECTaxes;

class HCECCombinationsController extends HCBaseController
{
    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        $goods = HCECGoods::findOrFail(request('goods_id'));

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.code_reference', array_get($_data, 'code_reference'));
        array_set($data, 'record.code_ean13', array_get($_data, 'code_ean13'));
        array_set($data, 'record.code_upc', array_get($_data, 'code_upc'));

        array_set($data, 'record.price_action', array_get($_data, 'price_action'));
        array_set($data, 'record.price_impact', array_get($_data, 'price_impact'));

        array_set($data, 'combination_images', array_get($_data, 'combination_images', []));

        // get prices
        if( array_get($_data, 'price_action') == 'impact' ) {
            $price = array_get($_data, 'price_tax_included');
            $tax   = HCECTaxes::findOrFail($goods->tax_id);
            list($priceTaxExcluded, $taxAmount) = PriceHelper::calcTaxes($price, $tax->value);

            // record
            array_set($data, 'record.price_tax_included', $price);
            array_set($data, 'record.price_tax_excluded', $priceTaxExcluded);
            array_set($data, 'record.price_tax_amount', $taxAmount);
        } else if( array_get($_data, 'price_action') == 'specific' ) {

            dd('Implement price reduction');
            // specific price
            array_set($data, 'specific_price.reduction_type', array_get($_data, 'reduction_type'));

            if( array_get($_data, 'reduction_type') == 'percentage' ) {
                $reduction = PriceHelper::convertToPercent(array_get($_data, 'reduction'));
            } else {
                $reduction = PriceHelper::replaceComma(array_get($_data, 'reduction'));
            }

            array_set($data, 'specific_price.goods_id', $goods->id);
            array_set($data, 'specific_price.reduction', $reduction);
            array_set($data, 'specific_price.date_from', array_get($_data, 'date_from'));
            array_set($data, 'specific_price.date_to', array_get($_data, 'date_to'));
        }

        return makeEmptyNullable($data);
    }

    /**
     * Getting single record
     *
     * @param string $goodsId
     * @param string $id
     * @return mixed
     */
    public function apiShow(string $goodsId, string $id = null)
    {
        $with = ['goods.translations'
//            ,'specific_price'
            , 'images'];

        $select = HCECCombinations::getFillableFields(true);

        $record = HCECCombinations::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

//        $record                     = $this->mapPriceObject($record);
//        $record->price_tax_included = PriceHelper::truncate($record->price_tax_included);
        $record->combination_images = $record->images->pluck('id');

        array_forget($record, [
            'specific_price',
            'image']);

        return $record;
    }

    /**
     * Map data object to object
     *
     * @param $item
     * @return mixed
     */
    protected function mapPriceObject($item)
    {
        if( $item->price_action == 'specific' && $item->specific_price ) {

            $item->reduction_type = $item->specific_price->reduction_type;

            if( $item->specific_price->reduction_type == 'percentage' ) {
                $item->reduction = PriceHelper::convertFromPercent($item->specific_price->reduction);
            } else {
                $item->reduction = $item->specific_price->reduction;
            }

            $item->date_from = $item->specific_price->date_from;
            $item->date_to   = $item->specific_price->date_to;
        }

        return $item;
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCECCombinations::findOrFail(request('id'));

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));
        $record->updateImages(array_get($data, 'combination_images'));

//        $record->updateSpecificPrice(array_get($data, 'specific_price', []), array_get($data, 'record.price_action'));

        return $this->apiShow($record->goods_id, $record->id);
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
    public function getCombinations($goodsId)
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
