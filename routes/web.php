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

//Test
Route::get('/test', 'PagesConrtoller@home');

//Pages
Route::get('/', ['as'=>'index_path', 'uses'=>'pagesController@index']);

Route::get('/user/{id}', ['as'=>'user_path', 'uses'=>'pagesController@user']);



//User
Route::post('/create', ['as'=>'create_user_path', 'uses'=>'pagesController@createUser']);


Route::get('/test', 'PagesController@hello');


//Friend
Route::get('/friend/delete/{user_id}/{friend_id}', ['as'=>'delete_friend_route', 'uses'=>'PagesController@deleteFriend']);


// Request
Route::get('/request/accept/{user_id}/{request_id}', ['as'=>'accept_request_path', 'uses'=>'PagesController@acceptRequest']);


Route::get('/request/decline/{user_id}/{request_id}', ['as'=>'decline_request_path', 'uses'=>'PagesController@declineRequest']);


Route::get('/request/create/{user_id}/{reciever_id}', ['as'=>'create_request_path', 'uses'=>'PagesController@createRequest']);