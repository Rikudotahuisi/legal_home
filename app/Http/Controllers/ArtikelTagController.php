<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use inertia\Inertia;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(10);
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tag,name',
        ]);

        $slug = Str::slug($request->name);

        // Cek unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Tag::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Tag::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('tag.index')
                ->with('success', 'Tag berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::with('artikels')->findOrFail($id);
        return view('tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:tag,name,' . $id,
        ]);

        $slug = Str::slug($request->name);

        // Cek unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Tag::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $tag->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('tag.index')
                ->with('success', 'Tag berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        // Detach semua relasi dengan artikel
        $tag->artikels()->detach();

        $tag->delete();

        return redirect()->route('tag.index')
                ->with('success', 'Tag berhasil dihapus!');
    }
}
