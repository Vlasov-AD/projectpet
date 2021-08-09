<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ErrorRequestController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\ResetPasswordController;

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

Route::group(['middleware' => ['web']], function () {
//
});

Route::get('/help', function () {
    return view('pages/help');
});

Route::get('/productpage', function(){
	return view('pages/productpage');
});

Route::get('/personaldata', function(){
	return view('pages.personaldata');
});

Route::get('/contact', function()
{
	return view('pages.contact');
});


Route::prefix('')
		->group(function(){
			Route::match(['get','post'],'', [BooksController::class, 'index']);
			Route::get('/showBook',[BooksController::class, 'show']);
			Route::post('/storeCommentary',[BooksController::class, 'store']);
			Route::get('/account', [UserController::class,'index']);
			Route::match(['get','post'],'/account/edit/{post}',[UserController::class, 'edit']);
			Route::match(['get', 'post'], '/CreateForm', [BooksController::class, 'createBook']);
			Route::match(['get', 'post'], '/CreateNewBook', [BooksController::class, 'create']);
			Route::match(['get', 'post'], '/EditForm', [BooksController::class, 'editBook']);
			Route::match(['get', 'post'], '/EditBook/{post}', [BooksController::class, 'edit']);
			Route::match(['get', 'post'], '/logout', [UserController::class, 'destroy']);
			Route::match(['get', 'post'], '/shopCart', [BooksController::class, 'shopCart']);
			Route::match(['get', 'post'], '/search', [BooksController::class, 'search']);
		});


Auth::routes();

//Для отправки писем


Route::get('/email/verify', function () {
    return view('pages.verify-email');
})->middleware('auth')->name('verification.notice');

//маршрут для ссылки из письма
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


//повторная отправка подтверждения, если удалено письмо или не пришло
Route::match(['get','post'],'/email/verificationResent', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('messageResentMail', 'Письмо для подтверждения регистрации повторно отправлено!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
*Восстановление пароля
*/

//Переадресация с письма на страницу со сменой пароля
Route::match(['get', 'post'], '/password/reset/{token}', function(ErrorRequestController $request)
{	//проверка почты из 
	$rules = $request->rulesSendEmailToReset();
    $messages = $request->messages();
    $validate = Validator::make($request->all(), $rules, $messages);
    if($validate->fails())
    {
    	return redirect('/')->withErrors($validate);
    }
    else
    {
    	return view('pages.resetPassword', ['token' => $request['token'], 
    										'email' => $request['email']]);
    }

 
	
})->middleware('guest')->name('password.reset');

//Метод сброса пароля

	//отправка ссылки на почту
	Route::post('/forgot-password', [ResetPasswordController::class, 'sendLinkToPassword']);
	//метод сброса пароля
	Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

		

