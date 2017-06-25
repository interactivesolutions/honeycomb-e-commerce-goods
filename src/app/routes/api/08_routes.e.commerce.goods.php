<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/goods'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'], 'uses' => 'ecommerce\\HCECGoodsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.goods.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.goods.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\HCECGoodsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.goods.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.goods.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_force_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\HCECGoodsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.goods.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\HCECGoodsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.goods.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'], 'uses' => 'ecommerce\\HCECGoodsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.goods.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_force_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiForceDelete']);
        });
    });
});