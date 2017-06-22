<?php

//honeycomb-e-commerce-goods/src/app/routes/admin/00_routes.e.commerce.taxes.php


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


//honeycomb-e-commerce-goods/src/app/routes/admin/01_routes.e.commerce.deposits.php


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


//honeycomb-e-commerce-goods/src/app/routes/admin/routes.e.commerce.manufacturers.php


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


//honeycomb-e-commerce-goods/src/app/routes/api/00_routes.e.commerce.taxes.php


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

//honeycomb-e-commerce-goods/src/app/routes/api/01_routes.e.commerce.deposits.php


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

//honeycomb-e-commerce-goods/src/app/routes/api/routes.e.commerce.manufacturers.php


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
