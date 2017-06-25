<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce\goods\types;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;

class HCECAttributesForm
{
    // name of the form
    protected $formID = 'e-commerce-goods-types-attributes';

    // is form multi language
    protected $multiLanguage = 1;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm (bool $edit = false)
    {
        $form = [
            'storageURL' => route ('admin.api.e.commerce.goods.types.attributes'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans ('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "type_id",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.type_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECTypes::with ('translations')->get (),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                [
                    "type"            => 'dropDownList',
                    "fieldID"         => 'dynamic',
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.dynamic"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => [
                        ['id' => '1', 'label' => trans ('HCTranslations::core.checkbox.yes')],
                        ['id' => '0', 'label' => trans ('HCTranslations::core.checkbox.no')],
                    ],
                    "value"           => "1",
                ],
                [
                    "type"            => 'dropDownList',
                    "fieldID"         => 'multilanguage',
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.multilanguage"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => [
                        ['id' => '1', 'label' => trans ('HCTranslations::core.checkbox.yes')],
                        ['id' => '0', 'label' => trans ('HCTranslations::core.checkbox.no')],
                    ],
                    "value"           => "0",
                    "dependencies"    =>
                        [
                            [
                                'field_id'    => 'dynamic',
                                'field_value' => "1",
                            ],
                        ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "min_select",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.min_select"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "dependencies"    =>
                        [
                            [
                                'field_id'    => 'dynamic',
                                'field_value' => "0",
                            ],
                        ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "max_select",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.max_select"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "dependencies"    => [
                        [
                            'field_id'    => 'dynamic',
                            'field_value' => "0",
                        ],
                    ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.description",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes.seo_keywords"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages ();

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}