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

/*
Route::get('/', function () {
    return view('welcome');
});
*/


/*
|--------------------------------------------------------------------------
| 静的ページ
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HelpController;


//toppage
Route::get('/', [PostsController::class, 'index']);

//about
Route::get('/about', [PostsController::class, 'about']);

//guide
Route::get('/guide', [PostsController::class, 'guide']);

//rule
Route::get('/rule', [PostsController::class, 'rule']);

//policy
Route::get('/policy', [PostsController::class, 'policy']);

//contact
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'confirm']);
Route::post('/contact/complete', [ContactController::class, 'complete']);
Route::get('/contact/thanks', [ContactController::class, 'thanks']);

//feedback
Route::get('/feedback', [ContactController::class, 'index2']);

//Help
Route::get('/help', [HelpController::class, 'help']);
Route::get('/help/{id}', [HelpController::class, 'helpshow']);




/*
|--------------------------------------------------------------------------
| 認証関連
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;


//ログイン
Route::get('/auth/login', [AuthController::class, 'getLogin']);
Route::post('/auth/login', [AuthController::class, 'postLogin']);
Route::get('/auth/confirm/{token}', [AuthController::class, 'getConfirm']);

//ログアウト
Route::get('/auth/logout', [AuthController::class, 'getLogout']);

//認証メール再送
Route::get('/auth/resend', [AuthController::class, 'getResend']);
Route::post('/auth/resend', [AuthController::class, 'postResend']);

//会員登録
Route::get('/auth/register', [AuthController::class, 'getRegister']);
Route::post('/auth/register', [AuthController::class, 'postRegister']);


//パスワードリセット
Route::get('/password/email', [PasswordController::class, 'getEmail']);
Route::post('/password/email', [PasswordController::class, 'postEmail']);
Route::get('/password/reset/{token}', [PasswordController::class, 'getReset']);
Route::post('/password/reset', [PasswordController::class, 'postReset']);



/*
|--------------------------------------------------------------------------
| レッスン関連
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\StudiesController;

//アクセスログ　 URLが/lesson/{id}と認識されるので、かならず//Postより前に記載すること
Route::post('/lesson/access', [PostsController::class, 'access']);

//レッスン一覧
Route::get('/lesson', [PostsController::class, 'lesson']);

//レッスン個別
Route::get('/lesson/{id}', [PostsController::class, 'lessonshow']);

//レッスンカテゴリー
Route::get('/lesson/category/{category_id}', [PostsController::class, 'lessoncategory']);

//学習記録
Route::post('/lesson/{id}/{post}/study', [StudiesController::class, 'store']);
Route::post('/lesson/{id}', [StudiesController::class, 'storeStatus']);


/*
|--------------------------------------------------------------------------
| お知らせ関連
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\NewsController;

//ニュース個別
Route::get('/news/{id}', [NewsController::class, 'newsshow'])->name('news.show');

//ニュース内フォーム
Route::post('/newscontact', [NewsController::class, 'confirm']);
Route::post('/newscontact/complete', [NewsController::class, 'complete']);
Route::get('/newscontact/thanks', [NewsController::class, 'thanks']);



/*
|--------------------------------------------------------------------------
| マイページ関連
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\user\UserController;

Route::group(['middleware' => ['auth:users']], function () {//この書き方がLaravel8で合っているのか不明
    Route::get('/mypage', [PostsController::class, 'mypage']);
    Route::get('/mypage/profile', [UserController::class, 'getProfile']);
    Route::patch('/mypage/profile/name', [UserController::class, 'postName']);
    Route::patch('/mypage/profile/avater', [UserController::class, 'postAvater']);
    Route::patch('/mypage/profile/email', [UserController::class, 'postUpdate']);
    Route::get('/mypage/confirm/{token}', [UserController::class, 'getConfirm']);
    Route::post('/mypage/profile/passwordSetting', [UserController::class, 'passwordSettingExec']);
});


/*
|--------------------------------------------------------------------------
| 管理画面関連
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\CategoriesController;


Route::get('/admin/login', [admin\AuthController::class, 'getLogin']);
Route::post('/admin/login', [admin\AuthController::class, 'postLogin']);
Route::get('/admin/logout', [admin\AuthController::class, 'getLogout']);

Route::group(['middleware' => ['auth:admin']], function () {
    
    //管理者登録
    Route::get('/admin/register', [admin\AuthController::class, 'getRegister']);
    Route::post('/admin/register', [admin\AuthController::class, 'postRegister']);

    //ホーム画面
    Route::get('/admin/home', [PostsController::class, 'home']);

    //レッスン投稿
    Route::get('/admin/lesson', [PostsController::class, 'post']);
    Route::get('/admin/lesson/create', [PostsController::class, 'create']);
    Route::get('/admin/lesson/{id}', [PostsController::class, 'show']);
    Route::get('/admin/lesson/{id}/edit', [PostsController::class, 'edit']);
    Route::post('/admin/lesson', [PostsController::class, 'store']);
    Route::patch('/admin/lesson/{id}', [PostsController::class, 'update']);
    Route::delete('/admin/lesson/{id}', [PostsController::class, 'destroy']);

    //ユーザー関連
    Route::get('/admin/userslist', [UserController::class, 'allusers']);
    Route::delete('/admin/userslist/{id}', [UserController::class, 'userdestroy']);
    Route::get('/admin/userslist/download', [UserController::class, 'userdownload']);
    
    //カテゴリー関連
    Route::get('/admin/category', [CategoriesController::class, 'index']);
    Route::get('/admin/category/create', [CategoriesController::class, 'create']);
    Route::get('/admin/category/{id}/edit', [CategoriesController::class, 'edit']);
    Route::get('/admin/category', [CategoriesController::class, 'store']);
    Route::patch('/admin/category/{id}', [CategoriesController::class, 'update']);
    Route::delete('/admin/category/{id}', [CategoriesController::class, 'destroy']);

    //ニュース投稿
    Route::get('/admin/news', [NewsController::class, 'news']);
    Route::get('/admin/news/create', [NewsController::class, 'create']);
    Route::get('/admin/news/{id}', [NewsController::class, 'show']);
    Route::get('/admin/news/{id}/edit', [NewsController::class, 'edit']);
    Route::post('/admin/news', [NewsController::class, 'store']);
    Route::patch('/admin/news/{id}', [NewsController::class, 'update']);
    Route::delete('/admin/news/{id}', [NewsController::class, 'destroy']);
    

    //ヘルプ投稿
    Route::get('/admin/help', [HelpController::class, 'help']);
    Route::get('/admin/help/create', [HelpController::class, 'create']);
    Route::get('/admin/help/{id}', [HelpController::class, 'show']);
    Route::get('/admin/help/{id}/edit', [HelpController::class, 'edit']);
    Route::post('/admin/help', [HelpController::class, 'store']);
    Route::patch('/admin/help/{id}', [HelpController::class, 'update']);
    Route::delete('/admin/help/{id}', [HelpController::class, 'destroy']);

});
