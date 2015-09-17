<?php

/*
|--------------------------------------------------------------------------
| 路由
|--------------------------------------------------------------------------
*/

#测试
Route::get('/test', 'TestController@index');
Route::post('/test', ['as' => 'test_upload', 'uses' => 'TestController@post']);
Route::get('/users/export', 'TestController@export');
Route::get('users', 'TestController@users');

#主页
Route::get('/', 'WelcomeController@index');


#登录，登出, 自动跳转, 密码重置
Route::get('login', ['middleware' => 'guest', 'as' => 'login', 'uses' => 'loginController@loginGet']);
Route::post('login', ['middleware' => 'guest', 'uses' => 'loginController@loginPost']);
Route::get('logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'loginController@logout']);
Route::controller('password', 'PasswordController');


#人员的登录详情(包括资料修改，查询)
Route::get('dm/home', ['as' => 'dm_home', 'uses' => 'DM\DiabetesController@home']);
Route::get('dm/edit', ['as' => 'dm_edit', 'uses' => 'DM\DiabetesController@edit']);
Route::post('dm/update', ['as' => 'dm_update', 'uses' => 'DM\DiabetesController@update']);


#管理员入口(增删改查，上传)
#Route::get('admin/grade', ['as' => 'grade_list', 'uses' => 'Admin\GradeController@index']);
#资源路由,人员的增删改查
Route::resource('admin', 'Admin\AdminController');
#更新信息
Route::post('admin/upload_user', ['as' => 'upload_user', 'uses' => 'Admin\AdminController@upload_user']);
#下载人员名单
Route::get('download/dmList', ['as' => 'download_dm_list_excel', 'uses' => 'Admin\ExcelController@dmList']);
#Route::get('download/grade', ['as' => 'download_grade_list_excel', 'uses' => 'Admin\ExcelController@grade']);


#功能管理
Route::resource('feature', 'Feature\FeatureController');
Route::post('feature/upload_feature', ['as' => 'upload_feature', 'uses' => 'Feature\FeatureController@upload_feature']);
#操作管理
Route::resource('hasfeature', 'Hasfeature\HasfeatureController');
Route::post('hasfeature/upload_hasfeature', ['as' => 'upload_hasfeature', 'uses' => 'Hasfeature\HasfeatureController@upload_hasfeature']);
