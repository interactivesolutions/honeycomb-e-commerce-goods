<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce\goods\types\attributes;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types\HCECAttributes;

class HCECValuesForm
{
    // name of the form
    protected $formID = 'e-commerce-goods-types-attributes-values';

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
            'storageURL' => route ('admin.api.routes.e.commerce.goods.types.attributes.values'),
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
                ],[
                    "type"            => "dropDownList",
                    "fieldID"         => "attribute_id",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes_values.attribute_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "type_id",
                            "options_url" => route ('admin.api.e.commerce.goods.types.attributes.list') . '?dynamic=0',
                        ],
                    ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes_values.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.description",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes_values.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes_values.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes_values.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types_attributes_values.seo_keywords"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
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