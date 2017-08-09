<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => 'api/e-commerce/goods/{_id}/combination'], function () {
        Route::post('generate', ['as' => 'admin.routes.e.commerce.goods.{_id}.combination.generate', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'], 'uses' => 'ecommerce\\goods\\HCECCombinationsController@generate']);
        Route::get('/', ['as' => 'admin.routes.e.commerce.goods.{_id}.combination', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\goods\\HCECCombinationsController@apiIndexPaginate']);

        Route::get('{id}', ['as' => 'admin.routes.e.commerce.goods.{_id}.combination.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\goods\\HCECCombinationsController@apiShow']);
        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update'], 'uses' => 'ecommerce\\goods\\HCECCombinationsController@apiUpdate']);
        Route::delete('{id}', ['as' => 'admin.routes.e.commerce.goods.{_id}.combination.{id}.delete', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\goods\\HCECCombinationsController@deleteCombination']);
    });
});
