<?php

namespace interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECAttributesTranslationsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'translations.*.label' => 'required',

        ];
    }
}