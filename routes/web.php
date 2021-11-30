<?php

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

// 라우드 동사 (get, post, put, delete, any, match)
Route::get('/', function () {
    return view('welcome');
});

// 컨트롤러 메서드 호출
use App\Http\Controllers\MemberController;
Route::get('login', [MemberController::class, 'login']);

// 라우트 이름 선언
Route::get('/' ,function () { return view('welcome'); })->name('home');

// 예제] 라우트 파라미터 정규 표현식 추가
Route::get('users/{id]', function ($id) {
    return '1';
})->where('id', '[0-9]+');

Route::get('users/{username}', function ($username) {
    return '2';
})->where('username', '[A-Za-z]+');

Route::get('posts/{id}/{slug}', function ($id, $slug) {
    return '3';
})->where(['id' => '[0-9]+', 'slug' => '[A-Za-z]+']);

// 그룹
Route::group([], function () {
    Route::get('hello', function () {
        return 'welcome';
    });
    Route::get('world', function () {
        return 'World';
    });
});

// 로그인한 사용자만 접근하게 지정한 라우트 그룹
Route::middleware('auth')->group(function () {
    Route::get('adshboard', function () {
        return 'adshboard';
    });
    Route::get('account', function() {
        return 'account';
    });
});

// 특정 라우트를 스로틀 미들웨어로 접속 제한하기
Route::middleware(['throttle:uploads'])->group(function () {
    Route::post('/photos', function () {
        //
    });
});

Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::get('/profile', function () {
        //
    });
});

// 라우트 그룹으로 URL에 접두사 붙이기
Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        // URL '/dashboard' 를 처리하는 로직
    });
    Route::get('users', function () {
        // URL '/dashboard/users'를 처리하는 로직
    });
});

// 모든 라우트 매칭 실패 시 대체 라우트 정의
Route::fallback(function () {
    return '실패';
});

// 서브도메인 라우팅
Route::domain('api.myapp.com')->group(function () {
    Route::get('/', function () {
        //
    });
});