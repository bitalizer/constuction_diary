<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
    'uses' => 'EventController@index_view',
    'name' => '/events',
    'middleware' => ['auth']
]);

//Events
Route::get('/events', 'EventController@index_view')->middleware('auth');
Route::post('/events/load', 'EventController@load')->middleware('auth');
Route::get('/events/load', 'EventController@load')->middleware('auth');

//Documents
Route::get('/documents', 'DocumentController@index')->middleware('auth', 'permission:view-diaries');
Route::match(['get', 'post'], '/documents/diary', 'DocumentController@diary')->middleware('auth', 'permission:view-diaries');
Route::get('/documents/diary/add', 'DocumentController@diary_add')->middleware('auth', 'permission:store-diary');
Route::get('/documents/diary/{id}', 'DocumentController@diary_view')->where('id', '[0-9]+')->middleware('auth', 'permission:view-diaries');
Route::get('/documents/diary/{id}/download', 'DocumentController@diary_download')->where('id', '[0-9]+')->middleware('auth', 'permission:view-diaries');
Route::post('/documents/diary/store', 'DocumentController@diary_store')->middleware('auth', 'permission:store-diary');
Route::post('/documents/diary/edit', 'DocumentController@diary_edit')->middleware('auth', 'permission:manage-diaries');
Route::post('/documents/diary/delete', 'DocumentController@diary_delete')->middleware('auth', 'permission:manage-diaries');
Route::post('/documents/diary/variables', 'DocumentController@diary_variables')->middleware('auth', 'permission:manage-diaries');

//Employees
Route::get('/employees', 'EmployeeController@index')->middleware(['auth', 'permission:view-employees']);
Route::get('/employees/{id}', 'EmployeeController@view')->where('id', '[0-9]+')->middleware('auth', 'permission:manage-employees');
Route::post('/employees/add', 'EmployeeController@add')->middleware('auth', 'permission:manage-employees');
Route::post('/employees/archive', 'EmployeeController@archive')->middleware('auth', 'permission:manage-employees');
Route::post('/employees/edit', 'EmployeeController@edit')->middleware('auth', 'permission:manage-employees');
Route::post('/employees/load', 'EmployeeController@load')->middleware('auth', 'permission:view-employees');

//Positions
Route::get('/positions', 'PositionController@index')->middleware(['auth', 'permission:view-positions']);
Route::get('/positions/add', 'PositionController@store_view')->middleware('auth', 'permission:manage-positions');
Route::get('/positions/{id}', 'PositionController@store_view')->where('id', '[0-9]+')->middleware('auth',  'permission:view-positions');
Route::post('/positions/store', 'PositionController@store')->middleware('auth', 'permission:manage-positions');
Route::post('/positions/delete', 'PositionController@delete')->middleware('auth', 'permission:manage-positions');

//Projects
Route::get('/projects', 'ProjectController@index')->middleware(['auth', 'permission:view-projects']);
Route::get('/projects/{id}', 'ProjectController@view')->where('id', '[0-9]+')->middleware('auth', 'permission:manage-projects');
Route::post('/projects/add', 'ProjectController@store')->middleware('auth', 'permission:manage-projects');
Route::post('/projects/archive', 'ProjectController@archive')->middleware('auth', 'permission:manage-projects');
Route::post('/projects/edit', 'ProjectController@edit')->middleware('auth', 'permission:manage-projects');
Route::post('/projects/load', 'ProjectController@load')->middleware('auth', 'permission:view-projects');

//Accounting
Route::match(['get', 'post'], '/accounting/payroll', 'AccountingController@payroll_view')->middleware('auth', 'permission:view-accounting');
Route::post('/accounting/payroll/update', 'AccountingController@payroll_update')->middleware('auth', 'permission:manage-accounting');

//Attendances
Route::get('/attendances/calendar', 'AttendanceController@calendar_view')->middleware(['auth', 'permission:view-attendances']);
Route::post('/attendances/calendar/load', 'AttendanceController@calendar_load')->middleware('auth', 'permission:view-attendances');
Route::match(['get', 'post'], '/attendances/table', 'AttendanceController@table_view')->middleware(['auth', 'permission:view-attendances']);
Route::match(['get', 'post'], '/attendances/table/{id}', 'AttendanceController@table_view')->where('id', '[0-9]+')->middleware(['auth', 'permission:view-attendances']);

//Settings
Route::get('/settings/general', 'SettingsController@general_view')->middleware('auth', 'permission:manage-settings');
Route::post('/settings/store', 'SettingsController@store')->middleware('auth', 'permission:manage-settings');

// Authentication routes...
Auth::routes();
// Resend routes...
Route::get('auth/resend', 'Auth\AuthController@getResend');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('logout', 'Auth\LoginController@logout');




