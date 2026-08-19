<?php
// app/Http/Controllers/ArtikelController.php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource (untuk Inertia).
     */
    public function index()
    {
        $artikels = Artikel::with(['creator', 'tags'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);

        return Inertia::render('home/Artikel', [
            'mode' => 'index',
            'artikels' => $artikels,
            'canCreate' => auth()->check()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        
        return Inertia::render('home/Artikel', [
            'mode' => 'create',
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artikeltitle' => 'required|string|max:255',
            'artikelcontent' => 'required|string',
            'slug' => 'nullable|string|unique:artikel,slug',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tag,id',
        ]);

        // Generate slug jika tidak diisi
        $slug = $request->slug ?? Str::slug($request->artikeltitle);
        
        // Cek unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // Buat artikel
        $artikel = Artikel::create([
            'artikeltitle' => $request->artikeltitle,
            'artikelcontent' => $request->artikelcontent,
            'slug' => $slug,
            'created_by' => auth()->id(),
        ]);

        // Attach tags jika ada
        if ($request->has('tags')) {
            $artikel->tags()->attach($request->tags);
        }

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $artikel = Artikel::with(['creator', 'tags'])->where('slug', $slug)->firstOrFail();

        return Inertia::render('home/Artikel', [
            'mode' => 'show',
            'artikel' => $artikel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $artikel = Artikel::with('tags')->where('slug', $slug)->firstOrFail();
        $tags = Tag::all();
        $selectedTags = $artikel->tags->pluck('id')->toArray();

        return Inertia::render('home/Artikel', [
            'mode' => 'edit',
            'artikel' => $artikel,
            'tags' => $tags,
            'selectedTags' => $selectedTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        $request->validate([
            'artikeltitle' => 'required|string|max:255',
            'artikelcontent' => 'required|string',
            'slug' => 'nullable|string|unique:artikel,slug,' . $artikel->id,
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tag,id',
        ]);

        // Generate slug jika tidak diisi
        $slug = $request->slug ?? Str::slug($request->artikeltitle);
        
        // Cek unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::withTrashed()->where('slug', $slug)->where('id', '!=', $artikel->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // Update artikel
        $artikel->update([
            'artikeltitle' => $request->artikeltitle,
            'artikelcontent' => $request->artikelcontent,
            'slug' => $slug,
        ]);

        // Sync tags
        if ($request->has('tags')) {
            $artikel->tags()->sync($request->tags);
        } else {
            $artikel->tags()->detach();
        }

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        $artikel->delete();

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Display a listing of trashed (soft deleted) resources.
     */
    public function trashed()
{
    // ===== CEK APAKAH USER ADMIN =====
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('artikel.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman sampah.');
    }

    $artikels = Artikel::onlyTrashed()
        ->with(['creator', 'tags'])
        ->orderBy('deleted_at', 'desc')
        ->paginate(9);

    return Inertia::render('home/Artikel', [
        'mode' => 'trashed',
        'artikels' => $artikels
    ]);
}

    public function restore($id)
{
    // ===== CEK APAKAH USER ADMIN =====
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('artikel.index')
                ->with('error', 'Anda tidak memiliki izin untuk memulihkan artikel.');
    }

    try {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        $artikel->restore();

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dipulihkan!');
    } catch (\Exception $e) {
        return redirect()->route('artikel.trashed')
                ->with('error', 'Gagal memulihkan artikel: ' . $e->getMessage());
    }
}

    public function forceDelete($id)
{
    // ===== CEK APAKAH USER ADMIN =====
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('artikel.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus permanen.');
    }

    try {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        $artikel->tags()->detach();
        $artikel->forceDelete();

        return redirect()->route('artikel.trashed')
                ->with('success', 'Artikel berhasil dihapus permanen!');
    } catch (\Exception $e) {
        return redirect()->route('artikel.trashed')
                ->with('error', 'Gagal menghapus permanen: ' . $e->getMessage());
    }
}
    // ===== METHOD UNTUK DATA API (Opsional) =====
    public function indexData()
    {
        return Artikel::with(['creator', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    public function getTags()
    {
        return Tag::all();
    }

    public function showData($slug)
    {
        return Artikel::with(['creator', 'tags'])->where('slug', $slug)->firstOrFail();
    }

    public function editData($slug)
    {
        $artikel = Artikel::with('tags')->where('slug', $slug)->firstOrFail();
        return [
            'artikel' => $artikel,
            'tags' => Tag::all(),
            'selectedTags' => $artikel->tags->pluck('id')->toArray()
        ];
    }

    public function trashedData()
    {
        return Artikel::onlyTrashed()
            ->with(['creator', 'tags'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(9);
    }
}