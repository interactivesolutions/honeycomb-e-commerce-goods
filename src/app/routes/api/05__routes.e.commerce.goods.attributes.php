<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/goods/attributes'], function ()
    {
        Route::get('/', ['as' => 'api.v1.e.commerce.goods.attributes', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.goods.attributes.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.e.commerce.goods.attributes.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.e.commerce.goods.attributes.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.goods.attributes.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.e.commerce.goods.attributes.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.e.commerce.goods.attributes.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.e.commerce.goods.attributes.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.e.commerce.goods.attributes.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.e.commerce.goods.attributes.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiForceDelete']);
        });
    });
});