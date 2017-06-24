<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/goods/types'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.goods.types', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.goods.types.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.goods.types.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.goods.types.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.goods.types.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.goods.types.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_force_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.goods.types.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.goods.types.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.goods.types.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.goods.types.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_force_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiForceDelete']);
        });
    });
});