<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/categories'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.categories', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create'], 'uses' => 'ecommerce\\HCECCategoriesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.categories.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.categories.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.categories.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update'], 'uses' => 'ecommerce\\HCECCategoriesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.categories.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.categories.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_force_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.categories.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update'], 'uses' => 'ecommerce\\HCECCategoriesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.categories.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update'], 'uses' => 'ecommerce\\HCECCategoriesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.categories.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create'], 'uses' => 'ecommerce\\HCECCategoriesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.categories.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_force_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiForceDelete']);
        });
    });
});