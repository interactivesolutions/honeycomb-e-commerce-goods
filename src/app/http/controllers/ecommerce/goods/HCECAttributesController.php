<?php

namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce\goods;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECAttributes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECAttributesTranslations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECDynamicAttributes;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\HCECAttributesTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\HCECAttributesValidator;

class HCECAttributesController extends HCBaseController
{
    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCECommerceGoods::e_commerce_goods_attributes.page_title'),
            'listURL'     => route('admin.api.e.commerce.goods.attributes'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-goods-attributes-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-goods-attributes-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete') )
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    private function getAdminListHeader()
    {
        return [
            'resource_id'                             => [
                "type"  => "image",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.resource_id'),
            ],
            'dynamic'                             => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.dynamic'),
            ],
            'multilanguage'                       => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.multilanguage'),
            ],
            'is_boolean'                          => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.is_boolean'),
            ],
//            'is_boolean'       => [
//                "type"  => "checkbox",
//                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.is_boolean'),
//                "url"   => route('admin.api.e.commerce.goods.attributes.update.strict', 'id')
//            ],
//            'translations.{lang}.description'     => [
//                "type"  => "text",
//                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.description'),
//            ],
            'translations.{lang}.label'           => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.label'),
            ],
//            'translations.{lang}.slug'            => [
//                "type"  => "text",
//                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.slug'),
//            ],
            'sequence'                          => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes.sequence'),
            ],
        ];
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __apiStore()
    {
        $data = $this->getInputData();

        $record = HCECAttributes::create(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));
        $record->updateTypes(array_get($data, 'types', []));

        return $this->apiShow($record->id);
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getInputData()
    {
        (new HCECAttributesValidator())->validateForm();
        (new HCECAttributesTranslationsValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        if( $_data['is_boolean'] == 1 && $_data['dynamic'] == 1 && $_data['multilanguage'] != 0 ) {
            throw new \Exception(trans('HCECommerceGoods::e_commerce_goods_attributes.errors.boolean_input'));
        }

        array_set($data, 'record.dynamic', array_get($_data, 'dynamic'));
        array_set($data, 'record.is_boolean', array_get($_data, 'is_boolean'));
        array_set($data, 'record.min_select', array_get($_data, 'min_select'));
        array_set($data, 'record.max_select', array_get($_data, 'max_select'));
        array_set($data, 'record.multilanguage', array_get($_data, 'multilanguage'));
        array_set($data, 'record.resource_id', array_get($_data, 'resource_id'));
        array_set($data, 'record.sequence', array_get($_data, 'sequence'));
        array_set($data, 'types', array_get($_data, 'types') ?? []);

        $translations = array_get($_data, 'translations');

        foreach ( $translations as &$value )
            if( ! isset($value['slug']) || $value['slug'] == "" )
                $value['slug'] = generateHCSlug("e-commerce/goods/attributes", $value['label']);

        array_set($data, 'translations', $translations);

        return makeEmptyNullable($data, true);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = ['translations', 'types'];

        $select = HCECAttributes::getFillableFields(true);

        $record = HCECAttributes::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCECAttributes::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));
        $record->updateTypes(array_get($data, 'types', []));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCECAttributes::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        HCECAttributesTranslations::destroy(HCECAttributesTranslations::whereIn('record_id', $list)->pluck('id')->toArray());
        HCECAttributes::destroy($list);

        // destroy related dynamic attributes
        HCECDynamicAttributes::whereIn('attribute_id', $list)->delete();

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        HCECAttributesTranslations::onlyTrashed()->whereIn('record_id', $list)->forceDelete();
        HCECAttributes::onlyTrashed()->whereIn('id', $list)->forceDelete();

        // force delete related dynamic attributes
        HCECDynamicAttributes::whereIn('attribute_id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        HCECAttributesTranslations::onlyTrashed()->whereIn('record_id', $list)->restore();
        HCECAttributes::whereIn('id', $list)->restore();

        // restore related dynamic attributes
        HCECDynamicAttributes::whereIn('attribute_id', $list)->restore();

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = ['translations'];

        if( $select == null )
            $select = HCECAttributes::getFillableFields();

        $list = HCECAttributes::with($with)
            ->select($select)
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);

                if( request()->has('type_id') ) {
                    $query->whereHas('types', function ($query) {
                        $query->where('type_id', request('type_id'));
                    });
                }
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        $r = HCECAttributes::getTableName();
        $t = HCECAttributesTranslations::getTableName();

        $query->where(function (Builder $query) use ($phrase) {
            $query->where('dynamic', 'LIKE', '%' . $phrase . '%')
                ->orWhere('min_select', 'LIKE', '%' . $phrase . '%')
                ->orWhere('max_select', 'LIKE', '%' . $phrase . '%')
                ->orWhere('multilanguage', 'LIKE', '%' . $phrase . '%');
        });

        return $query->join($t, "$r.id", "=", "$t.record_id")
            ->where('description', 'LIKE', '%' . $phrase . '%')
            ->orWhere('label', 'LIKE', '%' . $phrase . '%')
            ->orWhere('slug', 'LIKE', '%' . $phrase . '%')
            ->orWhere('seo_title', 'LIKE', '%' . $phrase . '%')
            ->orWhere('seo_description', 'LIKE', '%' . $phrase . '%')
            ->orWhere('seo_keywords', 'LIKE', '%' . $phrase . '%');
    }
}
