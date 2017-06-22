<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/manufacturers', ['as' => 'admin.e.commerce.manufacturers.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/manufacturers'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.manufacturers', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create'], 'uses' => 'ecommerce\\HCECManufacturersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.manufacturers.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.manufacturers.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update'], 'uses' => 'ecommerce\\HCECManufacturersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.manufacturers.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.manufacturers.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_force_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.manufacturers.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list'], 'uses' => 'ecommerce\\HCECManufacturersController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update'], 'uses' => 'ecommerce\\HCECManufacturersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.manufacturers.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update'], 'uses' => 'ecommerce\\HCECManufacturersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.manufacturers.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create'], 'uses' => 'ecommerce\\HCECManufacturersController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.manufacturers.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_force_delete'], 'uses' => 'ecommerce\\HCECManufacturersController@apiForceDelete']);
        });
    });
});
