<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/goods/attributes/values'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_force_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_force_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiForceDelete']);
        });
    });
});