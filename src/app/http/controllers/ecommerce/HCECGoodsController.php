<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce;

use Doctrine\Common\Annotations\Annotation\Attribute;
use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\helpers\PriceHelper;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECAttributes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECDynamicAttributes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoodsTranslations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECTaxes;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECGoodsTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECGoodsValidator;

class HCECGoodsController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'        => trans('HCECommerceGoods::e_commerce_goods.page_title'),
            'listURL'      => route('admin.api.routes.e.commerce.goods'),
            'newFormUrl'   => route('admin.api.form-manager', ['e-commerce-goods-new']),
            'editFormUrl'  => route('admin.api.form-manager', ['e-commerce-goods-edit']),
            'newRecordUrl' => 1,
            'imagesUrl'    => route('resource.get', ['/']),
            'headers'      => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete') )
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
            'translations.{lang}.label'      => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.label'),
            ],
            'type.translations.{lang}.label' => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.type_id'),
            ],
//            'virtual'                   => [
//                "type"  => "text",
//                "label" => trans('HCECommerceGoods::e_commerce_goods.virtual'),
//            ],
            'reference'                      => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.reference'),
            ],
            'ean_13'                         => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.ean_13'),
            ],
            'price'                          => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.price'),
            ],
            'tax.value'                      => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.tax_id'),
            ],
//            'price_before_tax'          => [
//                "type"  => "text",
//                "label" => trans('HCECommerceGoods::e_commerce_goods.price_before_tax'),
//            ],
            'deposit_id'                     => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.deposit_id'),
            ],
            'country_id'                     => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.country_id'),
            ],
            'manufacturer.name'              => [
                "type"  => "text",
                "label" => trans('HCECommerceGoods::e_commerce_goods.manufacturer_id'),
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

        $types = [
            'fieldID' => 'type_id',
            'type' => 'dropDownList',
            'label' => trans('HCECommerceGoods::e_commerce_goods.type_id'),
            'options' => HCECTypes::with('translations')->get()->toArray(),
            'showNodes' => ['translations.{lang}.label']
        ];

        $filters[] = addAllOptionToDropDownList($types);

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

        $record = HCECGoods::create(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));
        $record->updateImages(array_get($data, 'images'));

        $this->updateDynamicAttributes($record->id, $data);

        return $this->apiShow($record->id);
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECGoodsValidator())->validateForm();
        (new HCECGoodsTranslationsValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.type_id', array_get($_data, 'type_id'));
        array_set($data, 'record.virtual', array_get($_data, 'virtual'));
        array_set($data, 'record.reference', array_get($_data, 'reference'));
        array_set($data, 'record.ean_13', array_get($_data, 'ean_13'));
        array_set($data, 'record.deposit_id', array_get($_data, 'deposit_id'));
        array_set($data, 'record.country_id', array_get($_data, 'country_id'));
        array_set($data, 'record.gallery_id', array_get($_data, 'gallery_id'));
        array_set($data, 'record.manufacturer_id', array_get($_data, 'manufacturer_id'));
        array_set($data, 'record.tax_id', array_get($_data, 'tax_id'));

        $price = floatval(array_get($_data, 'price'));
        $tax = HCECTaxes::findOrFail(array_get($_data, 'tax_id'));

        list($priceBeforeTax, $taxAmount) = PriceHelper::calcTaxes($price, $tax->value);

        array_set($data, 'record.price', $price);
        array_set($data, 'record.price_before_tax', $priceBeforeTax);
        array_set($data, 'record.price_tax_amount', $taxAmount);

        $translations = array_get($_data, 'translations', []);

        foreach ( $translations as &$value ) {
            if( ! isset($value['slug']) || $value['slug'] == "" ) {
                $value['slug'] = generateHCSlug("e-commerce/goods", $value['label']);
            }
        }

        array_set($data, 'attributes', $this->getAttributeInputs($translations, $_data));
        array_set($data, 'translations', $translations);
        array_set($data, 'images', array_get($_data, 'images', []));

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
        $with = ['translations', 'images' => function ($query) {
            $query->select('id');
        }];

        $select = HCECGoods::getFillableFields(true);

        $record = HCECGoods::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        $record->price = PriceHelper::truncate($record->price);
        $record->price_before_tax = PriceHelper::truncate($record->price_before_tax);

        // get attributes
        // merge attributes to record
        $dynamic = HCECAttributes::isDynamicAttributes()->pluck('multilanguage', 'id');

        foreach ( $dynamic as $attributeId => $isMultiLanguage ) {
            $goods = HCECDynamicAttributes::where('attribute_id', $attributeId)->where('goods_id', $id)->first();

            if( is_null($goods) ) {
                continue;
            }

            if( $isMultiLanguage ) {
                $goods->load('translations');
                // merge to translations
                foreach ( $goods->translations as $translation ) {
                    foreach ( $record->translations as $key => $trans ) {
                        if( $trans->language_code == $translation->language_code ) {
                            $record['translations'][$key]['attributes__' . $attributeId] = $translation->value;
                        }
                    }
                }
            } else {
                // merge to object
                array_set($record, 'attributes__' . $attributeId, $goods->value);
            }
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
        $record = HCECGoods::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));
        $record->updateImages(array_get($data, 'images'));

        $this->updateDynamicAttributes($id, $data);

        return hcSuccess(trans('HCTranslations::core.updated'));
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCECGoods::where('id', $id)->update(request()->all());

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
        HCECGoodsTranslations::destroy(HCECGoodsTranslations::whereIn('record_id', $list)->pluck('id')->toArray());
        HCECGoods::destroy($list);

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
        HCECGoodsTranslations::onlyTrashed()->whereIn('record_id', $list)->forceDelete();
        HCECGoods::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECGoodsTranslations::onlyTrashed()->whereIn('record_id', $list)->restore();
        HCECGoods::whereIn('id', $list)->restore();

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
        $with = ['translations', 'type.translations', 'manufacturer', 'tax'];

        if( $select == null )
            $select = HCECGoods::getFillableFields();

        $list = HCECGoods::with($with)
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
        $query->where(function (Builder $query) use ($phrase) {
            $query->where('type_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('reference', 'LIKE', '%' . $phrase . '%')
                ->orWhere('ean_13', 'LIKE', '%' . $phrase . '%')
                ->orWhere('price', 'LIKE', '%' . $phrase . '%')
                ->orWhereHas('translations', function ($query) use ($phrase) {
                    $query->where("label", 'LIKE', '%' . $phrase . '%');
                });
        });

        return $query;
    }

    /**
     * @param $translations
     * @param $_data
     * @return array
     */
    protected function getAttributeInputs($translations, $_data): array
    {
        $attributes = [];

        foreach ( $translations as $key => $translation ) {
            foreach ( $translation as $field => $value ) {
                if( str_contains($field, 'attributes__') ) {
                    $attributes['translations'][$translation['language_code']][str_replace('attributes__', '', $field)] = $value;
                }
            }
        }

        $usedAttributes = [];

        foreach ( $_data as $field => $value ) {
            if( str_contains($field, 'attributes__') ) {
                if( is_array($value) ) {
                    $attributeId = str_replace('attributes__', '', $field);

                    $usedAttributes[] = $attributeId;

                    $attributes[$attributeId] = array_get($value, 0);
                } else {
                    $attributes[str_replace('attributes__', '', $field)] = $value;
                }
            }
        }

        // get all not selected attributes and set their value to 0
        $attributeRecords = HCECAttributes::isDynamicAttributes()->where('is_boolean', 1)->pluck('id')->all();

        $unusedAttributes = array_diff($attributeRecords, $usedAttributes);

        foreach ( $unusedAttributes as $unusedAttributeId ) {
            $attributes[$unusedAttributeId] = 0;
        }

        return $attributes;
    }

    /**
     * Update dynamic goods attributes
     *
     * @param string $goodsId
     * @param $data
     */
    protected function updateDynamicAttributes(string $goodsId, $data)
    {
        $translations = array_pull($data, 'attributes.translations', []);

        foreach ( $translations as $lang => $attributes ) {
            foreach ( $attributes as $attributeId => $value ) {
                $dynamicAttribute = HCECDynamicAttributes::firstOrCreate([
                    'attribute_id' => $attributeId,
                    'goods_id'     => $goodsId,
                ]);

                $dynamicAttribute->updateTranslation([
                    'language_code' => $lang,
                    'value'         => $value,
                ]);
            }
        }

        foreach ( array_get($data, 'attributes', []) as $attributeId => $value ) {
            $dynamicAttribute = HCECDynamicAttributes::firstOrNew([
                'attribute_id' => $attributeId,
                'goods_id'     => $goodsId,
            ]);

            $dynamicAttribute->value = $value;
            $dynamicAttribute->save();
        }
    }
}
