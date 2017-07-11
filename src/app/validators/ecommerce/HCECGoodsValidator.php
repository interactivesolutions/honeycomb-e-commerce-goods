<?php namespace interactivesolutions\honeycombecommercegoods\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECGoodsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules ()
    {
        return [
            'type_id'          => 'required',
            'price'            => 'required_without:price_before_tax',
            'price_before_tax' => 'required_without:price',

        ];
    }
}