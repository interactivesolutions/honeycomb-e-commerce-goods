<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce;

class HCECManufacturersForm
{
    // name of the form
    protected $formID = 'e-commerce-manufacturers';

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
            'storageURL' => route ('admin.api.e.commerce.manufacturers'),
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
                    "fieldID"         => "logo_id",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.logo_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "fileCount"       => 1,
                    "uploadDataTypes" => ["image/jpg","image/jpeg","image/png", "image/svg+xml"],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "name",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.name"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.description",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.seo_keywords"),
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
             "type"            => "singleLine",
             "fieldID"         => "slug",
             "tabID"           => trans('HCTranslations::core.general'),
             "label"           => trans ("HCECommerceGoods::e_commerce_manufacturers.slug"),
             "required"        => 1,
             "requiredVisible" => 1,
         ];

        return $form;
    }
}