<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'AdminController@index')->name('dashboard');
Route::get('getEmployees', 'AdminController@getEmployees')->name('get.employees');
Route::get('create-employee', 'AdminController@createEmployee')->name('create-employee');
Route::post('createEmployee', 'AdminController@createEmployeePost')->name('createEmployeePost');
Route::get('edit-employee/{id}', 'AdminController@updateEmployee')->name('updateEmployee');
Route::post('updateEmployee', 'AdminController@updateEmployeePost')->name('updateEmployeePost');
