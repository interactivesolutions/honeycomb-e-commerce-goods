<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECManufacturers;
use interactivesolutions\honeycombgalleries\app\models\Galleries;
use interactivesolutions\honeycombregions\app\models\regions\HCCountries;

class HCECGoodsForm
{
    // name of the form
    protected $formID = 'e-commerce-goods';

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
            'storageURL' => route ('admin.api.routes.e.commerce.goods'),
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
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.type_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECTypes::with ('translations')->get (),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                formManagerCheckBox('virtual', trans ("HCECommerceGoods::e_commerce_goods.virtual"),0,0, trans ('HCTranslations::core.general')),
                [
                    "type"            => "singleLine",
                    "fieldID"         => "reference",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.reference"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "ean_13",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.ean_13"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],  [
                    "type"            => "singleLine",
                    "fieldID"         => "price_before_tax",
                    "tabID"           => trans ('HCTranslations::core.price'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.price_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "price",
                    "tabID"           => trans ('HCTranslations::core.price'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "country_id",
                    "tabID"           => trans ('HCTranslations::core.price'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_taxes.country_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCCountries::select ('id', 'translation_key')->get (),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translation"],
                    ],
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "tax_id",
                    "tabID"           => trans ('HCTranslations::core.price'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.tax_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["value", "translations.{lang}.label"],
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "country_id",
                            "options_url" => route ('admin.api.e.commerce.taxes.list'),
                        ],
                    ],
                ],[
                    "type"            => "dropDownList",
                    "fieldID"         => "deposit_id",
                    "tabID"           => trans ('HCTranslations::core.price'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.deposit_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["value", "translations.{lang}.label"],
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "country_id",
                            "options_url" => route ('admin.api.e.commerce.deposits.list'),
                        ],
                    ],
                ],  [
                    "type"            => "dropDownList",
                    "fieldID"         => "gallery_id",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.gallery_id"),
                    "options"         => Galleries::with('translations')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["value", "translations.{lang}.title"],
                    ],
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "manufacturer_id",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.manufacturer_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECManufacturers::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["name"],
                    ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.short_description",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.short_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.long_description",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.long_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.slug",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.slug"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "label"           => trans ("HCECommerceGoods::e_commerce_goods.seo_keywords"),
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