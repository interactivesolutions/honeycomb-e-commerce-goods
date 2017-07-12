<?php

namespace interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\attributes;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECValuesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'attribute_id' => 'required',

        ];
    }
}