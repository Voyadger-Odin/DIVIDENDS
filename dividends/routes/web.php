<?php

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\SharesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//-------- LOGIN --------
Route::get('/login', function () {
    if (Auth::check()){
        return redirect(route('account'));
    }
    return view('login/login');
})->name('login');

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);


Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('home'));
})->name('logout');


Route::get('/registration', function () {
    if (Auth::check()){
        return redirect(route('account'));
    }
    return view('login/registration');
})->name('registration');

Route::post('/registration', [\App\Http\Controllers\LoginController::class, 'save']);
//-----------------------





Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/stock', [SharesController::class, 'getAllShares']);
Route::get('/stock/{ticker}', function ($ticker){
    return App::call('App\Http\Controllers\SharesController@getStockInfo' , ['ticker' => $ticker]);
});

Route::get('/calendar', [SharesController::class, 'getDividends']);

Route::get('/pricing', function () {
    return view('pricing');
});



Route::get('/account', function () {
    if (! Auth::check()){
        return redirect(route('login'));
    }

    return view('account');
})->name('account');

Route::get('/portfolio', function () {
    if (! Auth::check()){
        return redirect(route('login'));
    }

    return view('portfolio');
})->name('portfolio');


//-------- API --------
// Получение списка акций
Route::get('/api/get/shares', [APIController::class, 'getShare']);

// Установление новых акций
Route::post('/api/set/shares', [APIController::class, 'setShare']);

// Установление новых дивидендов
Route::post('/api/set/dividends', [APIController::class, 'setDividends']);

// Установление новых дивидендов
Route::get('/api/get/dividends', [APIController::class, 'getDididends']);

// Обновление цен
Route::post('/api/update/stocks_price', [APIController::class, 'updateStocksPrice']);

//---------------------



Route::get('/main', 'App\Http\Controllers\MainController@main');

