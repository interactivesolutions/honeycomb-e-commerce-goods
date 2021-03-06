<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECAttributes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECManufacturers;
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
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.routes.e.commerce.goods'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                formManagerCheckBox('active', trans("HCECommerceGoods::e_commerce_goods.active"), 0, 0, trans("HCTranslations::core.translations")),
                formManagerCheckBox('promoted', trans("HCECommerceGoods::e_commerce_goods.promoted"), 0, 0, trans("HCTranslations::core.translations")),
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "type_id",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.type_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECTypes::with('translations')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                formManagerCheckBox('virtual', trans("HCECommerceGoods::e_commerce_goods.virtual"), 0, 0, trans('HCTranslations::core.general')),
                [
                    "type"            => "singleLine",
                    "fieldID"         => "reference",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.reference"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "ean_13",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.ean_13"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "radioList",
                    "fieldID"         => "allow_pre_order",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.allow_pre_order"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => [
                        [
                            'id'    => '1',
                            'label' => trans('HCTranslations::core.yes'),
                        ],
                        [
                            'id'    => '0',
                            'label' => trans('HCTranslations::core.no'),
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "pre_order_count",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.pre_order_count"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "dependencies"    => [
                        [
                            'field_id'    => 'allow_pre_order',
                            'field_value' => '1',
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "pre_order_days",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.pre_order_days"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "dependencies"    => [
                        [
                            'field_id'    => 'allow_pre_order',
                            'field_value' => '1',
                        ],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "country_id",
                    "tabID"           => trans('HCTranslations::core.price'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.country_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCCountries::select('id', 'translation_key')->get(),
                    "value"           => app()->getLocale(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translation"],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "tax_id",
                    "tabID"           => trans('HCTranslations::core.price'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.tax_id"),
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
                            "options_url" => route('admin.api.e.commerce.taxes.list'),
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "price",
                    "tabID"           => trans('HCTranslations::core.price'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.price"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "deposit_id",
                    "tabID"           => trans('HCTranslations::core.price'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.deposit_id"),
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
                            "options_url" => route('admin.api.e.commerce.deposits.list'),
                        ],
                    ],
                ],
                [
                    'type'            => 'resource',
                    'fieldID'         => 'images',
                    'tabID'           => trans('HCTranslations::core.general'),
                    'label'           => trans('HCECommerceGoods::e_commerce_goods.images'),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", "/"),
                    "sortable"        => 1,
                    "uploadDataTypes" => ['image/jpeg'],
                    "uploadSize"      => "5120000",
                    "fileCount"       => 20,
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "manufacturer_id",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.manufacturer_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECManufacturers::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["name"],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "related",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.related_goods"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECGoods::with('translations')->select('id')->isActive()->get(),
                    "sortable"        => true,
                    "search"          => [
                        "maximumSelectionLength" => 10,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.short_description",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.short_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.long_description",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.long_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.additional_info",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.additional_info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "label"           => trans("HCECommerceGoods::e_commerce_goods.seo_keywords"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "multiLanguage"   => 1,
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        // add attributes tab to form
        $form['structure'] = array_merge($form['structure'], $this->getAttributesForm());

        if( ! $edit )
            return $form;


        $slug = [
            "type"            => "singleLine",
            "fieldID"         => "translations.slug",
            "label"           => trans("HCECommerceGoods::e_commerce_goods.slug"),
            "required"        => 1,
            "requiredVisible" => 1,
            "tabID"           => trans('HCTranslations::core.translations'),
            "multiLanguage"   => 1,
        ];

        $priceBT = [
            "type"            => "singleLine",
            "fieldID"         => "price_before_tax",
            "tabID"           => trans('HCTranslations::core.price'),
            "label"           => trans("HCECommerceGoods::e_commerce_goods.price_before_tax"),
            "readonly"        => 1,
            "required"        => 0,
            "requiredVisible" => 0,
        ];

        $priceTA = [
            "type"            => "singleLine",
            "fieldID"         => "price_tax_amount",
            "tabID"           => trans('HCTranslations::core.price'),
            "label"           => trans("HCECommerceGoods::e_commerce_goods.price_tax_amount"),
            "readonly"        => 1,
            "required"        => 0,
            "requiredVisible" => 0,
        ];

        //Make changes to edit form if needed
        $form['structure'][] = $slug;
        $form['structure'][] = $priceBT;
        $form['structure'][] = $priceTA;

        return $form;
    }

    /**
     * Get attributes form
     *
     * @return array
     */
    private function getAttributesForm()
    {
        $structure = [];

        $attributes = HCECAttributes::with('translations')->isDynamicAttributes()->orderBy('sequence')->get()->map(function ($item, $key) {

            $obj = new \stdClass();
            $obj->id = $item->id;
            $obj->multilanguage = $item->multilanguage ?? 0;
            $obj->is_boolean = $item->is_boolean;
            $obj->label = get_translation_name('label', app()->getLocale(), $item->translations->toArray());

            return $obj;
        });

        foreach ( $attributes as $attribute ) {

            if( $attribute->is_boolean ) {
                $structure[] = formManagerYesNo('checkBoxList', "attributes__$attribute->id", " $attribute->label", 0, 0, trans('HCTranslations::core.attributes'), false);
            } else {
                $structure[] = [
                    "type"            => "singleLine",
                    "fieldID"         => "attributes__$attribute->id",
                    "label"           => $attribute->label,
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "tabID"           => trans('HCTranslations::core.attributes'),
                    "multiLanguage"   => $attribute->multilanguage,
                ];
            }
        }

        return $structure;
    }
}