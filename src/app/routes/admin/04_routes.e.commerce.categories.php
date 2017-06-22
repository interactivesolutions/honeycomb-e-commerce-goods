<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/categories', ['as' => 'admin.e.commerce.categories.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/categories'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create'], 'uses' => 'ecommerce\\HCECCategoriesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.categories.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.categories.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update'], 'uses' => 'ecommerce\\HCECCategoriesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.categories.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.categories.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_force_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.categories.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list'], 'uses' => 'ecommerce\\HCECCategoriesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update'], 'uses' => 'ecommerce\\HCECCategoriesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.categories.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update'], 'uses' => 'ecommerce\\HCECCategoriesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.categories.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create'], 'uses' => 'ecommerce\\HCECCategoriesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.categories.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_force_delete'], 'uses' => 'ecommerce\\HCECCategoriesController@apiForceDelete']);
        });
    });
});
