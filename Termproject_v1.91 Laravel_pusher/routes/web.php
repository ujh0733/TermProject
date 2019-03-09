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
Route::get('/', 'BoardController@index')->name('/');

Auth::routes();

		/*	Login	*/

Route::get('login_page', 'MemberController@login_page')->name('login_page');

Route::get('closeLoginPage', 'MemberController@closeLoginPage')->name('closeLoginPage');

Route::get('signUp_page', 'MemberController@signUp_page');

Route::get('signUpSuccess', 'MemberController@signUpSuccess');	//회원가입하면 alert띄우고 메인페이지

Route::get('updateInformation_page', 'MemberController@updateInformation_page');

Route::post('updateInformation', 'MemberController@updateInformation');

Route::get('myPage', 'BoardController@myPage');

Route::get('banFailLogin', 'MemberController@banFailLogin');

Route::get('mail_check_page', function(){
	return view('mail_check_page');
});

		/*	Board	*/
		/*	Board View	*/
Route::get('board_page', 'BoardController@board')->name('board');

Route::get('board_page_list', 'BoardController@board_list');

Route::get('scrollPage', 'AjaxController@scrollPage');

Route::get('board_view', 'BoardController@view');


		/*	Board Write	*/
Route::get('write_page', 'BoardController@write_page');

Route::post('write', 'BoardController@write');


Route::post('ckUpload', 'BoardController@editorUpload')->name('ckUpload');

Route::get('updateBoard_page', 'BoardController@update_page');

Route::post('updateBoard', 'BoardController@updateBoard');

Route::post('deleteBoard', 'BoardController@delete');

Route::get('makeSeat_page', 'SeatController@makeSeat_page');

Route::post('makeSeat', 'SeatController@makeSeat');

Route::get('remainSeat', 'SeatController@remainSeat');		//잔여좌석

Route::get('buy_page', 'BuyController@buy_page');

Route::post('buy', 'BuyController@buy');


Route::get('cart', 'BoardController@cart');

Route::post('search', 'BoardController@search');

			/*	Map	*/
Route::get('viewTheaterMaps', 'BoardController@viewTheaterMaps');

Route::get('theaterMaps', 'BoardController@theaterMaps');

			/*	Ajax */
Route::get('buy_loadMoreData', 'AjaxController@getSeats');

Route::get('list_loadMoarData', 'AjaxController@getList');

Route::get('idCheck', 'AjaxController@idCheck');

Route::post('/comment', 'AjaxController@comment')->name('comment');

Route::get('myPageGet', 'AjaxController@myPageGet');

Route::post('withdrawal', 'AjaxController@withdrawal');

			/*	admin	*/
Route::get('adminPage', 'AdminController@adminPage');

Route::get('adminAjax', 'AdminController@adminAjax');

Route::post('adminPostAjax', 'AdminController@adminPostAjax');

			/*  pusher  */
Route::get('pusherServer', 'PusherController@pusherServer');
Route::post('pusherAjax', 'PusherController@pusherAjax');