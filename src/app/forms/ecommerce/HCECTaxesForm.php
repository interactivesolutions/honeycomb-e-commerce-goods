<?php

namespace interactivesolutions\honeycombecommercegoods\app\forms\ecommerce;

use interactivesolutions\honeycombregions\app\models\regions\HCCountries;

class HCECTaxesForm
{
    // name of the form
    protected $formID = 'e-commerce-taxes';

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
            'storageURL' => route ('admin.api.e.commerce.taxes'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans ('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "singleLine",
                    "fieldID"         => "value",
                    "label"           => trans ("HCECommerceGoods::e_commerce_taxes.value"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "country_id",
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
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "label"           => trans ("HCECommerceGoods::e_commerce_taxes.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "textArea",
                    "fieldID"         => "translations.description",
                    "label"           => trans ("HCECommerceGoods::e_commerce_taxes.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                    "rows"            => 5,
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