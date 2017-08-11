<?php

namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce\goods\attributes;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\attributes\HCECValues;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\attributes\HCECValuesTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\attributes\HCECValuesTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\attributes\HCECValuesValidator;

class HCECValuesController extends HCBaseController
{
    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCECommerceGoods::e_commerce_goods_attributes_values.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.goods.attributes.values'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-goods-attributes-values-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-goods-attributes-values-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete') )
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
            'attribute.translations.{lang}.label' => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.attribute_id'),
            ],
            'translations.{lang}.description'     => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.description'),
            ],
            'translations.{lang}.label'           => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.label'),
            ],
            'translations.{lang}.slug'            => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.slug'),
            ],
            'translations.{lang}.seo_title'       => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.seo_title'),
            ],
            'translations.{lang}.seo_description' => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.seo_description'),
            ],
            'translations.{lang}.seo_keywords'    => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods_attributes_values.seo_keywords'),
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

        $record = HCECValues::create(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));

        return $this->apiShow($record->id);
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECValuesValidator())->validateForm();
        (new HCECValuesTranslationsValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.attribute_id', array_get($_data, 'attribute_id'));

        $translations = array_get($_data, 'translations');

        foreach ( $translations as &$value )
            if( ! isset($value['slug']) || $value['slug'] == "" )
                $value['slug'] = generateHCSlug("e-commerce/goods/attributes/values", $value['label']);

        array_set($data, 'translations', $translations);

        return makeEmptyNullable($data);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = ['translations', 'attribute.types.translations'];

        $select = HCECValues::getFillableFields(true);

        $record = HCECValues::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        if( $record->attribute && $record->attribute->types->isNotEmpty() ) {
            $record->type_id = $record->attribute->types->first();
        }

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
        $record = HCECValues::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));

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
        HCECValues::where('id', $id)->update(request()->all());

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
        HCECValuesTranslations::destroy(HCECValuesTranslations::whereIn('record_id', $list)->pluck('id')->toArray());
        HCECValues::destroy($list);

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
        HCECValuesTranslations::onlyTrashed()->whereIn('record_id', $list)->forceDelete();
        HCECValues::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECValuesTranslations::onlyTrashed()->whereIn('record_id', $list)->restore();
        HCECValues::whereIn('id', $list)->restore();

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
        $with = ['translations', 'attribute.translations'];

        if( $select == null )
            $select = HCECValues::getFillableFields();

        $list = HCECValues::with($with)
            ->select($select)
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
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
        $r = HCECValues::getTableName();
        $t = HCECValuesTranslations::getTableName();

        $query->where(function (Builder $query) use ($phrase) {
            $query->where('attribute_id', 'LIKE', '%' . $phrase . '%');
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
