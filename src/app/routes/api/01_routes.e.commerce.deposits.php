<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/deposits'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.deposits', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create'], 'uses' => 'ecommerce\\HCECDepositsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.deposits.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.deposits.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.deposits.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update'], 'uses' => 'ecommerce\\HCECDepositsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.deposits.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.deposits.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_force_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.deposits.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list'], 'uses' => 'ecommerce\\HCECDepositsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update'], 'uses' => 'ecommerce\\HCECDepositsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.deposits.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update'], 'uses' => 'ecommerce\\HCECDepositsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.deposits.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create'], 'uses' => 'ecommerce\\HCECDepositsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.deposits.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_force_delete'], 'uses' => 'ecommerce\\HCECDepositsController@apiForceDelete']);
        });
    });
});