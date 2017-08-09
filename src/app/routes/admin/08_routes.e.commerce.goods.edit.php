<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function () {
    Route::get('e-commerce/goods/{_id}', ['as' => 'admin.routes.e.commerce.goods.{_id}.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_list'], 'uses' => 'ecommerce\\goods\\HCEditController@index']);
});
