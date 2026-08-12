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

Route::get('kuda', function () {
    return view('welcome');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/legality', [App\Http\Controllers\HomeController::class, 'legality'])->name('legality');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminSpace\AdminController::class, 'index'])->name("dashboard");

	Route::prefix('article')->group(function () {
	    Route::get('/list', [App\Http\Controllers\AdminSpace\ArticleController::class, "view_list"])->name("article-list");
	    Route::get('/create', [App\Http\Controllers\AdminSpace\ArticleController::class, "view_create"])->name("create-article");
		Route::get('/update', [App\Http\Controllers\AdminSpace\ArticleController::class, "view_update"])->name("update-article");

	    Route::post('/list', [App\Http\Controllers\AdminSpace\ArticleController::class, "post_list"])->name("list-article-post");
	    Route::post('/delete', [App\Http\Controllers\AdminSpace\ArticleController::class, "post_delete"])->name("delete-article-post");
	    Route::post('/create', [App\Http\Controllers\AdminSpace\ArticleController::class, "post_create"])->name("create-article-post");
	    Route::post('/update', [App\Http\Controllers\AdminSpace\ArticleController::class, "post_update"])->name("update-article-post");
	});

    Route::prefix('artikel-tag')->group(function () {
        Route::post('/attach', [App\Http\Controllers\AdminSpace\ArtikelTagController::class, "post_attach"])->name("attach-tag-post");
        Route::post('/detach', [App\Http\Controllers\AdminSpace\ArtikelTagController::class, "post_detach"])->name("detach-tag-post");
        Route::post('/sync', [App\Http\Controllers\AdminSpace\ArtikelTagController::class, "post_sync"])->name("sync-tag-post");
    });

    Route::prefix('tag')->group(function () {
        Route::get('/list', [App\Http\Controllers\AdminSpace\TagController::class, "view_list"])->name("tag-list");
        Route::get('/create', [App\Http\Controllers\AdminSpace\TagController::class, "view_create"])->name("create-tag");
        Route::get('/update/{id}', [App\Http\Controllers\AdminSpace\TagController::class, "view_update"])->name("update-tag");
        Route::get('/show/{id}', [App\Http\Controllers\AdminSpace\TagController::class, "view_show"])->name("show-tag");

        Route::post('/list', [App\Http\Controllers\AdminSpace\TagController::class, "post_list"])->name("list-tag-post");
        Route::post('/delete', [App\Http\Controllers\AdminSpace\TagController::class, "post_delete"])->name("delete-tag-post");
        Route::post('/create', [App\Http\Controllers\AdminSpace\TagController::class, "post_create"])->name("create-tag-post");
        Route::post('/update/{id}', [App\Http\Controllers\AdminSpace\TagController::class, "post_update"])->name("update-tag-post");
    });


	Route::prefix('license')->group(function () {
	    Route::get('/list', [App\Http\Controllers\AdminSpace\LicenseController::class, "view_list"])->name("license-list");
	    Route::get('/create', [App\Http\Controllers\AdminSpace\LicenseController::class, "view_create"])->name("create-license");
		Route::get('/update', [App\Http\Controllers\AdminSpace\LicenseController::class, "view_update"])->name("update-license");

	    Route::post('/delete', [App\Http\Controllers\AdminSpace\LicenseController::class, "post_delete"])->name("delete-license-post");
	    Route::post('/create', [App\Http\Controllers\AdminSpace\LicenseController::class, "post_create"])->name("create-license-post");
	    Route::post('/update', [App\Http\Controllers\AdminSpace\LicenseController::class, "post_update"])->name("update-license-post");
	});

	Route::prefix('user')->group(function () {
	    Route::get('/list', [App\Http\Controllers\AdminSpace\UserController::class, "view_list"])->name("user-list");
	    Route::get('/create', [App\Http\Controllers\AdminSpace\UserController::class, "view_create"])->name("create-user");
		Route::get('/update', [App\Http\Controllers\AdminSpace\UserController::class, "view_update"])->name("update-user");

	    Route::post('/delete', [App\Http\Controllers\AdminSpace\UserController::class, "post_delete"])->name("delete-user-post");
	    Route::post('/create', [App\Http\Controllers\AdminSpace\UserController::class, "post_create"])->name("create-user-post");
	    Route::post('/update', [App\Http\Controllers\AdminSpace\UserController::class, "post_update"])->name("update-user-post");
	});
});
