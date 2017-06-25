<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/goods', ['as' => 'admin.routes.e.commerce.goods.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/goods'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.goods', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'], 'uses' => 'ecommerce\\HCECGoodsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.goods.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.goods.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\HCECGoodsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.goods.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.goods.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_force_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.goods.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\HCECGoodsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\HCECGoodsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.goods.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\HCECGoodsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.goods.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'], 'uses' => 'ecommerce\\HCECGoodsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.goods.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_force_delete'], 'uses' => 'ecommerce\\HCECGoodsController@apiForceDelete']);
        });
    });
});
