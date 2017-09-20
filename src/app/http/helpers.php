<?php

use interactivesolutions\honeycombecommercegoods\app\helpers\HCPriceHelper;

if( ! function_exists('hcprice') ) {

    /**
     * Helper function which will be used with price calculations, rounding and etc..
     *
     * @return HCPriceHelper|string|array
     */
    function hcprice()
    {
        return new HCPriceHelper();
    }
}