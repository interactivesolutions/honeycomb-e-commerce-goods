<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;

class HCECCategoriesForm
{
    // name of the form
    protected $formID = 'e-commerce-categories';

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
            'storageURL' => route ('admin.api.e.commerce.categories'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans ('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "resource",
                    "fieldID"         => "resource_id",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.resource_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "fileCount"       => 1,
                    "uploadDataTypes" => ["image/jpg","image/jpeg","image/png", "image/svg+xml"],
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "parent_id",
                    "tabID"           => trans ('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.parent_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECCategories::select ('id')->with('translations')->get (),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ],[
                    "type"            => "textArea",
                    "fieldID"         => "translations.description",
                    "tabID"           => trans ('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                    "rows"            => 5
                ],  [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "tabID"           => trans ('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "tabID"           => trans ('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "tabID"           => trans ('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_categories.seo_keywords"),
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
        $form['structure'][] = [
            "type"     => "singleLine",
            "fieldID"  => "translations.slug",
            "label"    => trans ("HCECommerceGoods::e_commerce_categories.slug"),
            "readonly" => 1,
        ];

        return $form;
    }
}