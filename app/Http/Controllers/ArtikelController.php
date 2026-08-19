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
    public function show($id)
    {
        $artikel = Artikel::with(['creator', 'tags'])->findOrFail($id);

        return Inertia::render('home/Artikel', [
            'mode' => 'show',
            'artikel' => $artikel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $artikel = Artikel::with('tags')->findOrFail($id);
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
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'artikeltitle' => 'required|string|max:255',
            'artikelcontent' => 'required|string',
            'slug' => 'nullable|string|unique:artikel,slug,' . $id,
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tag,id',
        ]);

        // Generate slug jika tidak diisi
        $slug = $request->slug ?? Str::slug($request->artikeltitle);
        
        // Cek unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::withTrashed()->where('slug', $slug)->where('id', '!=', $id)->exists()) {
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
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Display a listing of trashed (soft deleted) resources.
     */
    public function trashed()
    {
        $artikels = Artikel::onlyTrashed()
                    ->with(['creator', 'tags'])
                    ->orderBy('deleted_at', 'desc')
                    ->paginate(9);

        return Inertia::render('home/Artikel', [
            'mode' => 'trashed',
            'artikels' => $artikels
        ]);
    }

    /**
     * Restore a soft deleted resource.
     */
    public function restore($id)
    {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        $artikel->restore();

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dipulihkan!');
    }

    /**
     * Permanently delete a resource.
     */
    public function forceDelete($id)
    {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);

        // Detach tags terlebih dahulu
        $artikel->tags()->detach();

        // Hapus permanen
        $artikel->forceDelete();

        return redirect()->route('artikel.trashed')
                ->with('success', 'Artikel berhasil dihapus permanen!');
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

    public function showData($id)
    {
        return Artikel::with(['creator', 'tags'])->findOrFail($id);
    }

    public function editData($id)
    {
        $artikel = Artikel::with('tags')->findOrFail($id);
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