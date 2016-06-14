<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/common', 'CommonController@index');
Route::post('/common', 'CommonController@save');

Route::get('/product', 'ProductController@index');
Route::put('/product', 'ProductController@create');
Route::get('/product/add', 'ProductController@show_edit');

Route::post('/send-email', function () {
	$to = Request::input('email');
	$subject = "Вашь пароль";
	try {
		$rec = App\Adm_users::where('email', '=', Request::input('email'))->firstOrFail();
	} catch (Exception $e) {
		echo "Email не найден";
		exit();
	}

	$header = "From: noreply@win-a-gift.ru\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/plain; charset=utf-8\r\n"; 
	$header.= "X-Priority: 1\r\n";

	$txt = "Ваш пароль: " . $rec->psw_restore;
	if (mail($to, $subject, $txt, $header) != false) {
		echo "Письмо отправлено";
	}
	
});