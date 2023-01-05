<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
# use App\Http\Middleware\LoginMiddleware; 미들웨어



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

Route::get('test', function () {
    return view('welcome');
});






# 메인 페이지
Route::get('MainPage', function () {
    return view('/MainPage/MainPage');
});

/*
# 메인 페이지
Route::get('MainPage', function () {
    return view('/MainPage/MainPage');
})->middleware(LoginMiddleware::class);
*/




# 로그인 폼
Route::get('LoginForm', function(){
    return view('/Login/LoginForm');
});

# 회원가입 폼
Route::get('RegForm', function(){
   return view('/Reg/RegForm');
});

# 로그인  get이면 [get, post면 post 형식에 맞춰서 보냄], MainPage라는 url생성 - ['사용한다는 의미'=>'컨트롤러 경로@함수', 'as' =>loginOk라는 곳(Form Action과 일치해야함)]
Route::match(['get','post'], 'LoginOk', ['uses' => 'App\Http\Controllers\Login\LoginController@fnUserLogin', 'as' => 'LoginOk']);
# 회원가입
Route::match(['get','post'], 'RegOk', ['uses' => 'App\Http\Controllers\Login\LoginController@fnReg', 'as' => 'RegOk']);
# 로그아웃
Route::match(['get','post'], 'LogOut', ['uses' => 'App\Http\Controllers\Login\LoginController@fnLogOut', 'as' => 'LogOut']);
# 마일리지 충전 폼
Route::match(['get','post'], 'MileChargeForm', ['uses' => 'App\Http\Controllers\Login\MileController@MileCharge', 'as' => 'MileChargeForm'])->middleware('login');;
# 마일리지 출금 폼
Route::match(['get','post'], 'MileWithdrawForm' ['uses' => 'App\Http\Controllers\Login\MileController@MileWithdraw'])