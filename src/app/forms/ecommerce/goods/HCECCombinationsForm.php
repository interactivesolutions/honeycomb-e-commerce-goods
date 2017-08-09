<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce\goods;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECSpecificPrice;

class HCECCombinationsForm
{
    // name of the form
    protected $formID = 'e-commerce-goods-combinations';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $goods = HCECGoods::with('translations')->find(request('goods'));

        $form = [
            'storageURL' => route('admin.routes.e.commerce.goods.{_id}.combination', request('goods')),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "goods",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods_attributes.types"),
                    "readonly"        => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => [],
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 0,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                [
                    'type'            => 'singleLine',
                    'fieldID'         => 'code_reference',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.code_reference'),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "maxLength"       => 12,
                ],
                [
                    'type'            => 'singleLine',
                    'fieldID'         => 'code_ean13',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.code_ean13'),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "maxLength"       => 13,
                ],
                [
                    'type'            => 'singleLine',
                    'fieldID'         => 'code_upc',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.code_upc'),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "maxLength"       => 12,
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'price_action',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.price_action'),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => [
                        ['id' => 'specific', 'label' => trans('HCECommerceGoods::e_commerce_goods_combinations.specific'),],
                        ['id' => 'impact', 'label' => trans('HCECommerceGoods::e_commerce_goods_combinations.impact'),],
                    ],
                    "search"          => [
                        'minimumInputLength'     => 0,
                        'maximumSelectionLength' => 1,
                    ],
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'reduction_type',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.reduction_type'),
                    "editType"        => 0,
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "value"           => 'amount',
                    "options"         => HCECSpecificPrice::getTableEnumList('reduction_type', 'label', 'HCECommerceGoods::e_commerce_goods_combinations.'),
                    "dependencies"    => [
                        [
                            "field_id"    => "price_action",
                            "field_value" => "specific",
                        ],
                    ],
                ],
                [
                    'type'            => 'singleLine',
                    'fieldID'         => 'reduction',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.reduction'),
                    "editType"        => 0,
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "maxLength"       => 20,
                    "dependencies"    => [
                        [
                            "field_id"    => "price_action",
                            "field_value" => "specific",
                        ],
                    ],
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "date_from",
                    "label"           => trans('HCECommerceGoods::e_commerce_goods_combinations.date_from'),
                    "editType"        => 0,
                    "required"        => 1,
                    "requiredVisible" => 1,
                    'properties'      => [
                        'format' => 'YYYY-MM-DD HH:mm:ss',
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "price_action",
                            "field_value" => "specific",
                        ],
                    ],
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "date_to",
                    "label"           => trans('HCECommerceGoods::e_commerce_goods_combinations.date_to'),
                    "editType"        => 0,
                    "required"        => 0,
                    "requiredVisible" => 0,
                    'properties'      => [
                        'format' => 'YYYY-MM-DD HH:mm:ss',
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "price_action",
                            "field_value" => "specific",
                        ],
                    ],
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'price_impact',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.price_impact'),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => [
                        [
                            'id'    => '1',
                            'label' => trans('HCECommerceGoods::e_commerce_goods_combinations.increase'),
                        ],
                        [
                            'id'    => '-1',
                            'label' => trans('HCECommerceGoods::e_commerce_goods_combinations.decrease'),
                        ],
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "price_action",
                            "field_value" => "impact",
                        ],
                    ],
                ],
                [
                    'type'            => 'singleLine',
                    'fieldID'         => 'price_tax_included',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.price_tax_included'),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "maxLength"       => 20,
                    "dependencies"    => [
                        [
                            "field_id"    => "price_action",
                            "field_value" => "impact",
                        ],
                    ],
                ],
                [
                    'type'            => 'checkBoxList',
                    'fieldID'         => 'combination_images',
                    'label'           => trans('HCECommerceGoods::e_commerce_goods_combinations.images'),
                    "editType"        => 0,
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => $goods ? $this->getGoodsImages($goods) : [],
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        if( ! $edit )
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }


    /**
     * Get product images
     *
     * @param $goods
     * @return array
     */
    public function getGoodsImages($goods)
    {
        $goods->load('images');

        if( ! $goods->images->count() )
            return [];

        return $goods->images->map(function ($item, $key) {
            return [
                'id'    => $item->id,
                'label' => sprintf("<img src='%s/300/300' style='max-height: 300px; max-width: 300px'/>", route('resource.get', $item->id)),
            ];
        });
    }
}