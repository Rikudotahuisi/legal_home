<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TagController;
use App\Models\Artikel;
use App\Models\Tag;

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
// ===== AUTH ROUTES =====
require __DIR__.'/auth.php';

Route::get('kuda', function () {
    return view('welcome');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/legality', [App\Http\Controllers\HomeController::class, 'legality'])->name('legality');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/galery', [App\Http\Controllers\HomeController::class, 'galery'])->name('galery');

// ===== ARTIKEL ROUTES =====
Route::prefix('artikel')->group(function () {
    Route::get('/', function () {
        $artikels = Artikel::with(['creator', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);
            
        return Inertia::render('home/Artikel', [
            'mode' => 'index',
            'artikels' => $artikels,
            'canCreate' => auth()->check()
        ]);
    })->name('artikel.index');

    Route::get('/create', function () {
        return Inertia::render('home/Artikel', [
            'mode' => 'create',
            'tags' => Tag::all()
        ]);
    })->middleware('auth')->name('artikel.create');

    Route::post('/', [ArtikelController::class, 'store'])
        ->middleware('auth')
        ->name('artikel.store');

    Route::get('/trashed', function () {
        $artikels = Artikel::onlyTrashed()
            ->with(['creator', 'tags'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(9);
            
        return Inertia::render('home/Artikel', [
            'mode' => 'trashed',
            'artikels' => $artikels
        ]);
    })->middleware('auth')->name('artikel.trashed');

    Route::post('/restore/{id}', [ArtikelController::class, 'restore'])
        ->middleware('auth')
        ->name('artikel.restore');

    Route::delete('/force-delete/{id}', [ArtikelController::class, 'forceDelete'])
        ->middleware('auth')
        ->name('artikel.force-delete');

    Route::get('/{id}', function ($id) {
        $artikel = Artikel::with(['creator', 'tags'])->findOrFail($id);
        
        return Inertia::render('home/Artikel', [
            'mode' => 'show',
            'artikel' => $artikel
        ]);
    })->name('artikel.show');

    Route::get('/{id}/edit', function ($id) {
        $artikel = Artikel::with('tags')->findOrFail($id);
        
        return Inertia::render('home/Artikel', [
            'mode' => 'edit',
            'artikel' => $artikel,
            'tags' => Tag::all(),
            'selectedTags' => $artikel->tags->pluck('id')->toArray()
        ]);
    })->middleware('auth')->name('artikel.edit');

    Route::put('/{id}', [ArtikelController::class, 'update'])
        ->middleware('auth')
        ->name('artikel.update');

    Route::delete('/{id}', [ArtikelController::class, 'destroy'])
        ->middleware('auth')
        ->name('artikel.destroy');
});

    Route::prefix('tag')->group(function () {
        Route::get('/list', [App\Http\Controllers\TagController::class, "view_list"])->name("tag-list");
        Route::get('/create', [App\Http\Controllers\TagController::class, "view_create"])->name("create-tag");
        Route::get('/update/{id}', [App\Http\Controllers\TagController::class, "view_update"])->name("update-tag");
        Route::get('/show/{id}', [App\Http\Controllers\TagController::class, "view_show"])->name("show-tag");

        Route::post('/list', [App\Http\Controllers\TagController::class, "post_list"])->name("list-tag-post");
        Route::post('/delete', [App\Http\Controllers\TagController::class, "post_delete"])->name("delete-tag-post");
        Route::post('/create', [App\Http\Controllers\TagController::class, "post_create"])->name("create-tag-post");
        Route::post('/update/{id}', [App\Http\Controllers\TagController::class, "post_update"])->name("update-tag-post");
    });
	