<?php namespace interactivesolutions\honeycombecommercegoods\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECManufacturersValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules ()
    {
        return [
            'name' => 'required',

        ];
    }
}