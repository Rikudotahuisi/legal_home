<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GaleriController;
use App\Models\Artikel;
use App\Models\Tag;
use App\Models\Galeri;

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

// ===== TEST ROUTE =====
Route::get('kuda', function () {
    return view('welcome');
});

// ===== PUBLIC ROUTES =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/legality', [HomeController::class, 'legality'])->name('legality');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/galery', [HomeController::class, 'galery'])->name('galery');

// ================================================================
// ===== ARTIKEL ROUTES (DENGAN INERTIA) =====
// ================================================================
Route::prefix('artikel')->group(function () {
    // Index - List semua artikel
    Route::get('/', function () {
        $artikels = Artikel::with(['creator', 'tags', 'galeris'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return Inertia::render('home/Artikel', [
            'mode' => 'index',
            'artikels' => $artikels,
            'canCreate' => auth()->check()
        ]);
    })->name('artikel.index');

    // Create - Form tambah artikel
    Route::get('/create', function () {
        return Inertia::render('home/Artikel', [
            'mode' => 'create',
            'tags' => Tag::all()
        ]);
    })->middleware('auth')->name('artikel.create');

    // Store - Simpan artikel baru
    Route::post('/', [ArtikelController::class, 'store'])
        ->middleware('auth')
        ->name('artikel.store');

    // Trashed - Artikel yang dihapus (soft delete)
    Route::get('/trashed', function () {
        $artikels = Artikel::onlyTrashed()
            ->with(['creator', 'tags', 'galeris'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(9);

        return Inertia::render('home/Artikel', [
            'mode' => 'trashed',
            'artikels' => $artikels
        ]);
    })->middleware('auth')->name('artikel.trashed');

    // Restore - Pulihkan artikel
    Route::post('/restore/{id}', [ArtikelController::class, 'restore'])
        ->middleware('auth')
        ->name('artikel.restore');

    // Force Delete - Hapus permanen
    Route::delete('/force-delete/{id}', [ArtikelController::class, 'forceDelete'])
        ->middleware('auth')
        ->name('artikel.force-delete');

    // Show - Detail artikel
    Route::get('/{id}', function ($id) {
        $artikel = Artikel::with(['creator', 'tags', 'galeris'])->findOrFail($id);

        return Inertia::render('home/Artikel', [
            'mode' => 'show',
            'artikel' => $artikel
        ]);
    })->name('artikel.show');

    // Edit - Form edit artikel
    Route::get('/{id}/edit', function ($id) {
        $artikel = Artikel::with(['tags', 'galeris'])->findOrFail($id);

        return Inertia::render('home/Artikel', [
            'mode' => 'edit',
            'artikel' => $artikel,
            'tags' => Tag::all(),
            'selectedTags' => $artikel->tags->pluck('id')->toArray()
        ]);
    })->middleware('auth')->name('artikel.edit');

    // Update - Simpan perubahan artikel
    Route::put('/{id}', [ArtikelController::class, 'update'])
        ->middleware('auth')
        ->name('artikel.update');

    // Delete - Hapus artikel (soft delete)
    Route::delete('/{id}', [ArtikelController::class, 'destroy'])
        ->middleware('auth')
        ->name('artikel.destroy');
});

// ================================================================
// ===== TAG ROUTES (ADMIN) =====
// ================================================================
Route::prefix('tag')->group(function () {
    Route::get('/list', [TagController::class, "view_list"])->name("tag-list");
    Route::get('/create', [TagController::class, "view_create"])->name("create-tag");
    Route::get('/update/{id}', [TagController::class, "view_update"])->name("update-tag");
    Route::get('/show/{id}', [TagController::class, "view_show"])->name("show-tag");

    Route::post('/list', [TagController::class, "post_list"])->name("list-tag-post");
    Route::post('/delete', [TagController::class, "post_delete"])->name("delete-tag-post");
    Route::post('/create', [TagController::class, "post_create"])->name("create-tag-post");
    Route::post('/update/{id}', [TagController::class, "post_update"])->name("update-tag-post");
});

// ================================================================
// ===== GALERI ROUTES (TAMBAHKAN INI) =====
// ================================================================
Route::prefix('galeri')->group(function () {
    // List galeri berdasarkan artikel
    Route::get('/list/{artikelId}', [GaleriController::class, "view_list"])
        ->middleware('auth')
        ->name("galeri-list");

    // Create galeri
    Route::get('/create/{artikelId}', [GaleriController::class, "view_create"])
        ->middleware('auth')
        ->name("create-galeri");

    Route::post('/create/{artikelId}', [GaleriController::class, "post_create"])
        ->middleware('auth')
        ->name("create-galeri-post");

    // Show galeri
    Route::get('/show/{artikelId}/{id}', [GaleriController::class, "view_show"])
        ->middleware('auth')
        ->name("show-galeri");

    // Update galeri
    Route::get('/update/{artikelId}/{id}', [GaleriController::class, "view_update"])
        ->middleware('auth')
        ->name("update-galeri");

    Route::post('/update/{artikelId}/{id}', [GaleriController::class, "post_update"])
        ->middleware('auth')
        ->name("update-galeri-post");

    // Delete galeri
    Route::post('/delete', [GaleriController::class, "post_delete"])
        ->middleware('auth')
        ->name("delete-galeri-post");

    // Set cover
    Route::post('/set-cover', [GaleriController::class, "post_set_cover"])
        ->middleware('auth')
        ->name("set-cover-post");

    Route::post('/set-slide', [GaleriController::class, 'post_set_slide'])
        ->middleware('auth')
        ->name('set-slide-post');

    Route::post('/reorder-slides', [GaleriController::class, 'post_reorder_slides'])
        ->middleware('auth')
        ->name('reorder-slides-post');
});

// ================================================================
// ===== API ROUTES UNTUK GALERI (OPSIONAL) =====
// ================================================================
Route::prefix('api')->group(function () {
    // Get galeri by artikel ID (untuk Inertia/React)
    Route::get('/galeri/{artikelId}', function ($artikelId) {
        $galeris = Galeri::where('artikel_id', $artikelId)
            ->orderBy('urutan', 'asc')
            ->get();

        return response()->json($galeris);
    })->name('api.galeri.by-artikel');
});
