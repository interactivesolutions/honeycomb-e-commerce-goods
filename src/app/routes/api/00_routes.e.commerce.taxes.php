<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/taxes'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.taxes', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create'], 'uses' => 'ecommerce\\HCECTaxesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.taxes.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.taxes.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.taxes.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update'], 'uses' => 'ecommerce\\HCECTaxesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.taxes.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.taxes.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_force_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.taxes.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update'], 'uses' => 'ecommerce\\HCECTaxesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.taxes.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update'], 'uses' => 'ecommerce\\HCECTaxesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.taxes.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create'], 'uses' => 'ecommerce\\HCECTaxesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.taxes.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_force_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiForceDelete']);
        });
    });
});