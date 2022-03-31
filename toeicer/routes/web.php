<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Models\User;
use App\Models\Book;


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

//ログイン画面を表示へ
Route::get('loginForm', [UserController::class, 'showLogin'])->name('loginForm');

//新規登録画面を表示へ
Route::get('newLogin', [UserController::class, 'newLogin'])->name('newLog');

//新規登録完了画面を表示+ユーザ情報を登録へ
Route::post('completeLogin', [UserController::class, 'register'])->name('completeLogin');

// パスワードリセット関連
Route::get('/resetForm', [UserController::class, 'reset'])->name('resetForm');
Route::post('/resetRegister', [UserController::class, 'resetRegister'])->name('resetComplete');

//ログイン認証処理へ
Route::post('login', [UserController::class, 'login'])->name('login');



//投稿一覧画面へ
Route::middleware(['guest'])->group(function () {
Route::get('gene_postList', function() {
    return view('main.postList');
    })->name('gene_postList');
});

Route::middleware(['auth'])->group(function () {
    //認証後マイページへ
    Route::get('myPage', function() {
        return view('main.myPage');
    })->name('myPage');

    //いいね一覧画面へ
    Route::get('likeList', [BookController::class, 'likeList'])->name('likeList');

    //ログアウト処理
    Route::post('logout',[UserController::class, 'logout'])->name('logout');

    //投稿画面へ
    Route::get('postForm', function() {
        return view('main.postForm');
    })->name('postForm');

    //投稿内容を登録へ
    Route::post('postRegister', [BookController::class, 'register'])->name('postRegister');

    //いいね登録
    Route::post('like', [BookController::class, 'like'])->name('bookLike');

    //いいね一覧画面へ
    Route::get('likeList', function() {
    return view('main.likeList');
    })->name('likeList');

    //いいね一覧表示
    Route::get('fetch-likes', [BookController::class, 'fetchLike'])->name('fetchLike');

    Route::get('postList', [BookController::class, 'postList'])->name('postList');

    Route::post('isLike', [BookController::class, 'isLike'])->name('isLike');
});

//投稿リスト表示
Route::get('fetch-books', [BookController::class, 'fetchBook'])->name('fetchBook');

//投稿リストをレベル別にソートして表示
Route::get('fetchCertainBooks/{category}', [BookController::class, 'search'])->name('fetchCertainBook');


//投稿詳細表示
Route::get('detail/{id}', [BookController::class, 'viewDetail'])->name('detail');

