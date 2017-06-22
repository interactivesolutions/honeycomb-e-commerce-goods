<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/manufacturers'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.manufacturers', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create'], 'uses' => 'ecommerce\\HCECManufacturersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.manufacturers.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.manufacturers.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.manufacturers.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update'], 'uses' => 'ecommerce\\HCECManufacturersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.manufacturers.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.manufacturers.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_force_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.manufacturers.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update'], 'uses' => 'ecommerce\\HCECManufacturersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.manufacturers.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update'], 'uses' => 'ecommerce\\HCECManufacturersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.manufacturers.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create'], 'uses' => 'ecommerce\\HCECManufacturersController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.manufacturers.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_force_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiForceDelete']);
        });
    });
});