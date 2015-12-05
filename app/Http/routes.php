<?php

/*
|--------------------------------------------------------------------------
| 路由
|--------------------------------------------------------------------------
*/

#测试
#Route::get('/test', 'TestController@index');
#Route::post('/test', ['as' => 'test_upload', 'uses' => 'TestController@post']);
#Route::get('/users/export', 'TestController@export');
#Route::get('users', 'TestController@users');

#主页
Route::get('/', 'WelcomeController@index');
Route::get('logs', 'LogViewerController@index');

#登录，登出, 自动跳转, 密码重置
Route::get('login', ['middleware' => 'guest', 'as' => 'login', 'uses' => 'loginController@loginGet']);
Route::post('login', ['middleware' => 'guest', 'uses' => 'loginController@loginPost']);
Route::get('logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'loginController@logout']);
Route::controller('password', 'PasswordController');
#关于
Route::get('/about', ['middleware' => 'auth', 'as' => 'about', 'uses' => 'Pages\PagesController@about']);

#人员的登录详情(包括资料修改，查询)
Route::get('dm/home', ['as' => 'dm_home', 'uses' => 'DM\DiabetesController@home']);
Route::get('dm/personal', ['as' => 'dm_personal', 'uses' => 'DM\DiabetesController@personal']);
Route::get('dm/edit', ['as' => 'dm_edit', 'uses' => 'DM\DiabetesController@edit']);
Route::get('dm/create', ['as' => 'dm_create', 'uses' => 'DM\DiabetesController@create']);
Route::get('dm/eedit/{id}', ['as' => 'dm_eedit', 'uses' => 'DM\DiabetesController@eedit']);
Route::delete('dm/destroy/{id}', ['as' => 'dm_destroy', 'uses' => 'DM\DiabetesController@destroy']);
Route::post('dm/update', ['as' => 'dm_update', 'uses' => 'DM\DiabetesController@update']);
Route::post('dm/uupdate', ['as' => 'dm_uupdate', 'uses' => 'DM\DiabetesController@uupdate']);
Route::post('dm/store', ['as' => 'dm_store', 'uses' => 'DM\DiabetesController@store']);
Route::get('dm/gobd/{pid}', ['as' => 'dm_gobd', 'uses' => 'DM\DiabetesController@gobd']);

#管理员入口(增删改查，上传)
#资源路由,人员的增删改查
Route::resource('admin', 'Admin\AdminController');
#更新信息
Route::post('admin/upload_user', ['as' => 'upload_user', 'uses' => 'Admin\AdminController@upload_user']);
#下载人员名单
Route::get('download/dmList', ['as' => 'download_dm_list_excel', 'uses' => 'Admin\ExcelController@dmList']);

#功能管理
Route::resource('feature', 'Feature\FeatureController');
Route::post('feature/upload_feature', ['as' => 'upload_feature', 'uses' => 'Feature\FeatureController@upload_feature']);
#操作管理
Route::resource('hasfeature', 'Hasfeature\HasfeatureController');
#Route::post('hasfeature/upload_hasfeature', ['as' => 'upload_hasfeature', 'uses' => 'Hasfeature\HasfeatureController@upload_hasfeature']);
#轨迹纪录
Route::resource('event', 'Event\EventController');

#一般人员入口
#患者基本资料
Route::resource("patient", "Patient\PatientprofileController");
#关于
Route::get('/aboutpatient', ['as' => 'aboutpatient', 'uses' => 'Patient\PatientprofileController@about']);
Route::get('patient/ccreate/{personid}', ['as' => 'patient_ccreate', 'uses' => 'Patient\PatientprofileController@ccreate']);

#方案管理
Route::resource("case", "Cases\CaseController");
#关于
Route::get('/aboutcase', ['as' => 'aboutcase', 'uses' => 'Cases\CaseController@about']);
Route::get('case/create/{personid}', ['as' => 'case_create', 'uses' => 'Cases\CaseController@create']);

#血糖
Route::get('/bdata/foods/{food_category_id}', 'BData\BDataController@get_food_category');
Route::get('/bdata/food/statics', 'BData\BDataController@get_all_stat');
Route::get('/bdata/blood/chart', 'BData\BDataController@get_blood_chart');
Route::delete('/bdata/foods/{calendar_date}', 'BData\BDataController@delete_food');
Route::get('/bdata/detail/{calendar_date}/{measuretype}', 'BData\BDataController@get_detail');
Route::get('/bdata/message', 'BData\BDataController@message');
Route::get('/bdata/filter', 'BData\BDataController@get_filter');
Route::post('/bdata/upsert_note', 'BData\BDataController@upsert_note');
Route::post('/bdata/post_message', 'BData\BDataController@post_message');
Route::post('/bdata/batch_update', 'BData\BDataController@batch_update');
Route::post('/bdata/upsert', 'BData\BDataController@upsert');
Route::post('/bdata/upsertfood', 'BData\BDataController@upsertfood');
Route::get('/bdata/food/detail/{calendar_date}/{measuretype}', 'BData\BDataController@get_food_detail');
Route::get('/bdata/{uuid?}/{end?}',['as' => 'bdata', 'uses' => 'BData\BDataController@page'] );

#SOAP
Route::get('/soap/get_sub/{main_class_pk}', 'SOAP\SoapController@get_sub_class');
Route::get('/soap/get_soa/{sub_class_pk}', 'SOAP\SoapController@get_soa_class');
Route::get('/soap/get_soa_detail/{soa_class_pk}', 'SOAP\SoapController@get_soa_detail');
Route::get('/soap/get_customize/{class}/{type}', 'SOAP\SoapController@get_customize');
Route::get('/soap_history/{uuid}', 'SOAP\SoapController@get_history');
Route::post('/soap/get_customize', 'SOAP\SoapController@post_customize');
Route::post('/soap/post_soap', 'SOAP\SoapController@post_user_soap');
Route::post('/soap/delete_history', 'SOAP\SoapController@delete_history');
Route::get('/soap/{uuid}', 'SOAP\SoapController@page');
