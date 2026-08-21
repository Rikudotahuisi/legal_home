<?php
// app/Http/Controllers/ArtikelController.php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArtikelController extends Controller
{
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

    public function create()
    {
        $tags = Tag::all();
        
        return Inertia::render('home/Artikel', [
            'mode' => 'create',
            'tags' => $tags,
            'canManageTags' => auth()->check() && auth()->user()->role === 'admin'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'artikeltitle' => 'required|string|max:255',
            'artikelcontent' => 'required|string',
            'slug' => 'nullable|string|unique:artikels,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',  // <-- PERBAIKI: tags,id
        ]);

        // Generate slug
        $slug = $request->slug ?? Str::slug($request->artikeltitle);
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = '/storage/' . $request->file('image')->store('artikel', 'public');
        }

        // Buat artikel
        $artikel = Artikel::create([
            'artikeltitle' => $request->artikeltitle,
            'artikelcontent' => $request->artikelcontent,
            'slug' => $slug,
            'image' => $imagePath,
            'created_by' => auth()->id(),
        ]);

        // ===== ATTACH TAGS (HANYA SEKALI) =====
        if ($request->has('tags') && !empty($request->tags)) {
            $artikel->tags()->attach($request->tags);
        }

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dibuat!');
    }

    public function show($slug)
    {
        $artikel = Artikel::with(['creator', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        return Inertia::render('home/Artikel', [
            'mode' => 'show',
            'artikel' => $artikel
        ]);
    }

    public function edit($slug)
    {
        $artikel = Artikel::with('tags')->where('slug', $slug)->firstOrFail();
        $tags = Tag::all();
        $selectedTags = $artikel->tags->pluck('id')->toArray();

        return Inertia::render('home/Artikel', [
            'mode' => 'edit',
            'artikel' => $artikel,
            'tags' => $tags,
            'selectedTags' => $selectedTags,
            'canManageTags' => auth()->check() && auth()->user()->role === 'admin'
        ]);
    }

    public function update(Request $request, $slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        $request->validate([
            'artikeltitle' => 'required|string|max:255',
            'artikelcontent' => 'required|string',
            'slug' => 'nullable|string|unique:artikels,slug,' . $artikel->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',  // <-- PERBAIKI: tags,id
        ]);

        // Generate slug
        $newSlug = $request->slug ?? Str::slug($request->artikeltitle);
        $originalSlug = $newSlug;
        $counter = 1;
        while (Artikel::withTrashed()->where('slug', $newSlug)->where('id', '!=', $artikel->id)->exists()) {
            $newSlug = $originalSlug . '-' . $counter++;
        }

        // Upload gambar baru jika ada
        $imagePath = $artikel->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($artikel->image) {
                $oldImage = str_replace('/storage/', '', $artikel->image);
                Storage::disk('public')->delete($oldImage);
            }
            $imagePath = '/storage/' . $request->file('image')->store('artikel', 'public');
        }

        // Update artikel
        $artikel->update([
            'artikeltitle' => $request->artikeltitle,
            'artikelcontent' => $request->artikelcontent,
            'slug' => $newSlug,
            'image' => $imagePath,
        ]);

        // ===== SYNC TAGS =====
        if ($request->has('tags')) {
            $artikel->tags()->sync($request->tags);
        } else {
            $artikel->tags()->detach();
        }

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        
        // Hapus gambar jika ada
        if ($artikel->image) {
            $imagePath = str_replace('/storage/', '', $artikel->image);
            Storage::disk('public')->delete($imagePath);
        }
        
        $artikel->delete();

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dihapus!');
    }

    public function restore($id)
    {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        $artikel->restore();

        return redirect()->route('artikel.index')
                ->with('success', 'Artikel berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        $artikel = Artikel::onlyTrashed()->findOrFail($id);
        
        // Hapus gambar jika ada
        if ($artikel->image) {
            $imagePath = str_replace('/storage/', '', $artikel->image);
            Storage::disk('public')->delete($imagePath);
        }
        
        $artikel->tags()->detach();
        $artikel->forceDelete();

        return redirect()->route('artikel.trashed')
                ->with('success', 'Artikel berhasil dihapus permanen!');
    }

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
}