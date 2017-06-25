<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/goods/types/attributes'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.goods.types.attributes', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_create'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.goods.types.attributes.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.goods.types.attributes.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.goods.types.attributes.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_update'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.goods.types.attributes.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.goods.types.attributes.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.goods.types.attributes.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_update'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.goods.types.attributes.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_update'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.goods.types.attributes.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_create'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.goods.types.attributes.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiForceDelete']);
        });
    });
});