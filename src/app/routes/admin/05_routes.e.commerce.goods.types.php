<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/goods/types', ['as' => 'admin.e.commerce.goods.types.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/goods/types'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.goods.types', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.goods.types.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.goods.types.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.goods.types.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.goods.types.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_force_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.goods.types.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.goods.types.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.goods.types.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.goods.types.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_force_delete'], 'uses' => 'ecommerce\\goods\\HCECTypesController@apiForceDelete']);
        });
    });
});
