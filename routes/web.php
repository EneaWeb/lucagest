<?php

Route::get('/services', 'ServiceController@index');
Route::get('/areas', 'AreaController@index');
Route::get('/options', 'OptionController@index');
Route::get('/orders', 'OrderController@index'); 
Route::get('/order', 'OrderController@index');
Route::get('/', 'OrderController@index');

Route::get('/orders/new', 'OrderController@newOrder');
Route::get('/order/edit/{id}', 'OrderController@editOrder');
Route::get('/order/{id}', 'OrderController@showOrder');
Route::get('/order/pdf/{id}', 'OrderController@PDF');

Route::get('/service/modal/edit', 'ServiceController@modal_edit');
Route::get('/api/get-servce-supplier-price', 'ServiceController@getServiceSupplierPrice');

Route::post('/service/save', 'ServiceController@saveService');
Route::post('/service/delete', 'ServiceController@deleteService');
Route::post('/service/edit', 'ServiceController@editService');

Route::post('/area/save', 'AreaController@saveArea');
Route::post('/area/delete', 'AreaController@deleteArea');
Route::post('/area/edit', 'AreaController@editArea');

Route::post('/options/save', 'OptionController@saveOption');

Route::post('/orders/new/save', 'OrderController@saveOrder');
Route::post('/order/delete', 'OrderController@deleteOrder');
Route::post('/order/sendmail', 'OrderController@sendmail');
