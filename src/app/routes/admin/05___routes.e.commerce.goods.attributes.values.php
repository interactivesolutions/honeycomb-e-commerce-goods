<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/goods/attributes/values', ['as' => 'admin.routes.e.commerce.goods.attributes.values.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/goods/attributes/values'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.goods.attributes.values.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_force_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_update'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_create'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.goods.attributes.values.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_attributes_values_force_delete'], 'uses' => 'ecommerce\\goods\\attributes\\HCECValuesController@apiForceDelete']);
        });
    });
});
