<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TagController;
use App\Models\Artikel;
use App\Models\Tag;
use App\Http\Controllers\GaleriController;

require __DIR__.'/auth.php';

// ===== HALAMAN DEPAN =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/legality', [HomeController::class, 'legality'])->name('legality');


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

    Route::get('/{slug}', function ($slug) {
        $artikel = Artikel::with(['creator', 'tags'])->where('slug', $slug)->firstOrFail();

        return Inertia::render('home/Artikel', [
            'mode' => 'show',
            'artikel' => $artikel
        ]);
    })->name('artikel.show');

    Route::get('/{slug}/edit', function ($slug) {
        $artikel = Artikel::with('tags')->where('slug', $slug)->firstOrFail();

        return Inertia::render('home/Artikel', [
            'mode' => 'edit',
            'artikel' => $artikel,
            'tags' => Tag::all(),
            'selectedTags' => $artikel->tags->pluck('id')->toArray()
        ]);
    })->middleware('auth')->name('artikel.edit');

    Route::put('/{slug}', [ArtikelController::class, 'update'])
        ->middleware('auth')
        ->name('artikel.update');

    Route::delete('/{slug}', [ArtikelController::class, 'destroy'])
        ->middleware('auth')
        ->name('artikel.destroy');
});

// ============================================================
// ===== GALERI ROUTES =====
// ============================================================
Route::get('/galery', [GaleriController::class, 'index'])->name('galery');

// ===== ROUTE KHUSUS ADMIN BUAT GALERI =====
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/galery/create', [GaleriController::class, 'create'])->name('galery.create');
    Route::post('/galery', [GaleriController::class, 'store'])->name('galery.store');
    Route::delete('/galery/{id}', [GaleriController::class, 'destroy'])->name('galery.destroy');
}); 

// ============================================================
// ===== TAG ROUTES (Satu File Vue) =====
// ============================================================
Route::prefix('tag')->group(function () {
    // ===== LIST =====
    Route::get('/list', function () {
        return Inertia::render('admin/Tag', [
            'mode' => 'list',
            'tags' => Tag::all()
        ]);
    })->middleware('auth')->name('tag-list');

    // ===== CREATE =====
    Route::get('/create', function () {
        return Inertia::render('admin/Tag', [
            'mode' => 'create'
        ]);
    })->middleware('auth')->name('create-tag');

    Route::post('/create', [TagController::class, 'post_create'])
        ->middleware('auth')
        ->name('create-tag-post');

    // ===== EDIT =====
    Route::get('/update/{id}', function ($id) {
        $tag = Tag::findOrFail($id);
        return Inertia::render('admin/Tag', [
            'mode' => 'edit',
            'tag' => $tag
        ]);
    })->middleware('auth')->name('update-tag');

    Route::post('/update/{id}', [TagController::class, 'post_update'])
        ->middleware('auth')
        ->name('update-tag-post');

    // ===== DELETE =====
    Route::post('/delete', [TagController::class, 'post_delete'])
        ->middleware('auth')
        ->name('delete-tag-post');
});

// ============================================================
// ===== ADMIN DASHBOARD =====
// ============================================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('admin/Dashboard', [
            'totalArticles' => Artikel::count(),
            'totalUsers' => \App\Models\User::count(),
            'trashedArticles' => Artikel::onlyTrashed()->count(),
        ]);
    })->name('admin.dashboard');
});