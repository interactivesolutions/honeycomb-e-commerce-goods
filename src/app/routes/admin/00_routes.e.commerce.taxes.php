<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/taxes', ['as' => 'admin.e.commerce.taxes.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/taxes'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.taxes', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create'], 'uses' => 'ecommerce\\HCECTaxesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.taxes.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.taxes.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update'], 'uses' => 'ecommerce\\HCECTaxesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.taxes.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.taxes.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_force_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.taxes.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list'], 'uses' => 'ecommerce\\HCECTaxesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update'], 'uses' => 'ecommerce\\HCECTaxesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.taxes.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update'], 'uses' => 'ecommerce\\HCECTaxesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.taxes.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create'], 'uses' => 'ecommerce\\HCECTaxesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.taxes.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_force_delete'], 'uses' => 'ecommerce\\HCECTaxesController@apiForceDelete']);
        });
    });
});
