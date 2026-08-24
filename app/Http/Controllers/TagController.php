<?php
// app/Http/Controllers/TagController.php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TagController extends Controller
{
    // ===== LIST TAGS =====
    public function view_list()
    {
        $tags = Tag::all();
        return Inertia::render('admin/Tag', [
            'mode' => 'list',
            'tags' => $tags
        ]);
    }

    // ===== CREATE TAG =====
    public function view_create()
    {
        return Inertia::render('admin/Tag', [
            'mode' => 'create'
        ]);
    }

    public function post_create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name'
        ]);

        // ===== GENERATE SLUG =====
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Tag::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Tag::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('tag-list')
                ->with('success', 'Tag berhasil ditambahkan!');
    }

    // ===== EDIT TAG =====
    public function view_update($id)
    {
        $tag = Tag::findOrFail($id);
        return Inertia::render('admin/Tag', [
            'mode' => 'edit',
            'tag' => $tag
        ]);
    }

    public function post_update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id
        ]);

        // ===== GENERATE SLUG BARU =====
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Tag::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $tag->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('tag-list')
                ->with('success', 'Tag berhasil diperbarui!');
    }

    // ===== DELETE TAG =====
    public function post_delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tags,id'
        ]);

        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        return redirect()->route('tag-list')
                ->with('success', 'Tag berhasil dihapus!');
    }
}