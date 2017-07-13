<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce\goods;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;

class HCECTypesForm
{
    // name of the form
    protected $formID = 'e-commerce-goods-types';

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
            'storageURL' => route ('admin.api.e.commerce.goods.types'),
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
                    "fieldID"         => "categories",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans("HCECommerceGoods::e_commerce_categories.page_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECCategories::with('translations')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 20,
                        "minimumSelectionLength" => 0,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "textArea",
                    "fieldID"         => "translations.description",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods_types.seo_keywords"),
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