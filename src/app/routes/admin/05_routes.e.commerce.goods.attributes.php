<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/goods/attributes', ['as' => 'admin.e.commerce.goods.attributes.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/goods/attributes'], function ()
    {
        Route::get('/', ['as' => 'admin.api.e.commerce.goods.attributes', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.e.commerce.goods.attributes.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.e.commerce.goods.attributes.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.e.commerce.goods.attributes.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.e.commerce.goods.attributes.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.e.commerce.goods.attributes.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.e.commerce.goods.attributes.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_update'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.e.commerce.goods.attributes.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_list', 'acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_create'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.e.commerce.goods.attributes.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_attributes_force_delete'], 'uses' => 'ecommerce\\goods\\HCECAttributesController@apiForceDelete']);
        });
    });
});
