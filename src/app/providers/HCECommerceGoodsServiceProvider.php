<?php

namespace interactivesolutions\honeycombecommercegoods\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCECommerceGoodsServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombecommercegoods\app\http\controllers';

    public $serviceProviderNameSpace = 'HCECommerceGoods';
}





