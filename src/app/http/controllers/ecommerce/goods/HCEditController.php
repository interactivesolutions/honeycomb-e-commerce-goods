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
            'combinations' => app(HCECCombinationsController::class)->getCombinations($good->id),
        ];

        return hcview('HCECommerceGoods::edit', ['config' => $config]);
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

}
