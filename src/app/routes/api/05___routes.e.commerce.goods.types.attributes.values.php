<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/goods/types/attributes/values'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_list'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_create'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_list'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_list'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_update'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_force_delete'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_list'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_update'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_update'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_create'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.goods.types.attributes.values.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_types_attributes_values_force_delete'], 'uses' => 'ecommerce\\goods\\types\\attributes\\HCECValuesController@apiForceDelete']);
        });
    });
});