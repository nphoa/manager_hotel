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

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index');
Route::get('/customers','Category\CustomerController@getPagination');

//Customer
//Method Get
Route::get('/getAll','Category\CustomerController@getAll');
Route::get('/getByIdCustomer/{id}','Category\CustomerController@getById');
//Method Post
Route::post('/create_Customer','Category\CustomerController@create');

//Floor
//Method Get
Route::get('/floors','Category\FloorController@getPagination');
Route::get('/getByIdFloor/{id}','Category\FloorController@getById');
//Method Post
Route::post('/create_Floor','Category\FloorController@create');

//Services
//Method Get
Route::get('/services','Category\ServiceController@getPagination');
Route::get('/getByIdService/{id}','Category\ServiceController@getById');
//Method Post
Route::post('/create_Service','Category\ServiceController@AddOrModifyOrDeleteInstance');

//Room
//Method Get
Route::get('/rooms','Category\RoomController@getPagination');
Route::get('/getByIdRoom/{id}','Category\RoomController@getById');
//Method Post
Route::post('/create_Room','Category\RoomController@AddOrModifyOrDeleteInstance');

//ChekInCheckOut
Route::get('/checkinorcheckout','Handle\CheckInCheckOutController@index');
Route::post('/handle','Handle\CheckInCheckOutController@handle');
Route::get('/getInfoDetail/{mode}/{id_room}/{id_room_register}','Handle\CheckInCheckOutController@getInfoDetail');
Route::post('/deleteRoomRegisterCustomer','Handle\CheckInCheckOutController@deleteRoomRegisterCustomer');
Route::post('/deleteRoomRegisterService','Handle\CheckInCheckOutController@deleteRoomRegisterService');

//History
Route::get('/history','Handle\HistoryController@index');