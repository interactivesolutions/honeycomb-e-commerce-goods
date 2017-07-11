<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function () {
    Route::get('e-commerce/goods/{_id}', ['as' => 'admin.routes.e.commerce.goods.{_id}.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\goods\\HCEditController@index']);

    Route::group(['prefix' => 'api/e-commerce/goods/{_id}'], function () {
        Route::post('generate', ['as' => 'admin.routes.e.commerce.goods.{_id}.generate', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'], 'uses' => 'ecommerce\\goods\\HCEditController@generate']);
        Route::delete('combination/{id}', ['as' => 'admin.routes.e.commerce.goods.{_id}.combination.{id}.delete', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'], 'uses' => 'ecommerce\\goods\\HCEditController@deleteCombination']);
    });
});
