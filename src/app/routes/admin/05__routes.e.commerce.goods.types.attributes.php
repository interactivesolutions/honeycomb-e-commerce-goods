<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/goods/types/attributes', ['as' => 'admin.e.commerce.goods.types.attributes.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/goods/types/attributes'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.goods.types.attributes', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_create'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.goods.types.attributes.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.goods.types.attributes.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_update'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.goods.types.attributes.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.goods.types.attributes.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.goods.types.attributes.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_update'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.goods.types.attributes.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_update'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.goods.types.attributes.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_create'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.goods.types.attributes.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\types\\HCECAttributesController@apiForceDelete']);
        });
    });
});
