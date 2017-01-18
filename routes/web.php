<?php

#Admin Routes
Route::get('admin/login', 'AdminController@redirectToGoogle');
Route::get('admin/logout', 'AdminController@logout');
Route::get('admin/callback', 'AdminController@handleGoogleCallback');
Route::get('admin/notice', 'AdminController@notice');
Route::get('admin', 'AdminController@index');
#Content Routes
foreach (config('site.content') as $content => $config) {
    Route::resource('admin/'.$content, ucfirst($content).'Controller');
}
Route::resource('admin/modules', 'ModulesController');

#Frontend Routes
Route::get('/', 'FrontendController@index');
Route::get('lien-he', 'FrontendController@contact');
Route::get('san-pham', 'FrontendController@product');
Route::get('hoi-dap/{value?}', 'FrontendController@question');
Route::get('video/{value?}', 'FrontendController@video');
Route::get('phan-phoi/{value?}', 'FrontendController@delivery');
Route::get('tu-khoa/{value?}', 'FrontendController@tag');
Route::post('saveContact', 'FrontendController@saveContact');
Route::get('{value}', 'FrontendController@main');