<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/deposits', ['as' => 'admin.e.commerce.deposits.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/deposits'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.deposits', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create'], 'uses' => 'ecommerce\\HCECDepositsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.deposits.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.deposits.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update'], 'uses' => 'ecommerce\\HCECDepositsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.deposits.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.deposits.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_force_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.deposits.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update'], 'uses' => 'ecommerce\\HCECDepositsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.deposits.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update'], 'uses' => 'ecommerce\\HCECDepositsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.deposits.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create'], 'uses' => 'ecommerce\\HCECDepositsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.deposits.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_force_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiForceDelete']);
        });
    });
});
