<?php
// app/Http/Controllers/GaleriController.php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('home/Galery', [
            'galeris' => $galeris,
            'canCreate' => auth()->check() && auth()->user()->role === 'admin'
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/GaleriCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->storeAs('galeri', time() . '.' . $request->file('image')->extension(), 'public');
        
        // ===== PATH LENGKAP =====
        $fullPath = '/storage/' . $imagePath;

        $galeri = Galeri::create([
            'title' => $request->title,
            'image' => $fullPath,
            'category' => $request->category,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        // ===== DEBUG: Cek data yang tersimpan =====
        \Log::info('Galeri created:', $galeri->toArray());

        return redirect()->route('galery')
                ->with('success', 'Foto berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file gambar
        $imagePath = str_replace('/storage/', '', $galeri->image);
        Storage::disk('public')->delete($imagePath);

        $galeri->delete();

        return redirect()->route('galery')
                ->with('success', 'Foto berhasil dihapus!');
    }
}