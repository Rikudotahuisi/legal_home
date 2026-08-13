<?php

namespace App\Http\Controllers\AdminSpace;

use App\Models\Artikel;
use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the gallery for an article.
     */
    public function view_list($artikelId)
    {
        $artikel = Artikel::with('galeri')->findOrFail($artikelId);
        return view('admin.galeri.list', compact('artikel'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function view_create($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        return view('admin.galeri.create', compact('artikel'));
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function post_create(Request $request, $artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);

        $request->validate([
            'file' => 'required|file|max:20480', // max 20MB
            'judul_gambar' => 'nullable|string|max:255',
            'tipe_media' => 'required|in:gambar,video',
            'is_cover' => 'nullable|boolean',
            'keterangan' => 'nullable|string',
        ]);

        // Upload file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('galeri/artikel_' . $artikelId, $fileName, 'public');

        // Jika dijadikan cover, update cover lainnya menjadi false
        if ($request->is_cover) {
            Galeri::where('artikel_id', $artikelId)->where('is_cover', true)->update(['is_cover' => false]);
        }

        // Cari urutan terakhir
        $lastOrder = Galeri::where('artikel_id', $artikelId)->max('urutan') ?? 0;

        // Simpan ke database
        $galeri = Galeri::create([
            'artikel_id' => $artikelId,
            'judul_gambar' => $request->judul_gambar ?? $fileName,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $this->formatFileSize($file->getSize()),
            'tipe_media' => $request->tipe_media,
            'is_cover' => $request->is_cover ?? false,
            'urutan' => $lastOrder + 1,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('galeri-list', $artikelId)
                ->with('success', 'Media berhasil ditambahkan!');
    }

    /**
     * Display the specified gallery item.
     */
    public function view_show($artikelId, $id)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $galeri = Galeri::where('artikel_id', $artikelId)->findOrFail($id);

        return view('admin.galeri.show', compact('artikel', 'galeri'));
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function view_update($artikelId, $id)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $galeri = Galeri::where('artikel_id', $artikelId)->findOrFail($id);

        return view('admin.galeri.update', compact('artikel', 'galeri'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function post_update(Request $request, $artikelId, $id)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $galeri = Galeri::where('artikel_id', $artikelId)->findOrFail($id);

        $request->validate([
            'judul_gambar' => 'nullable|string|max:255',
            'is_cover' => 'nullable|boolean',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        // Jika dijadikan cover, update cover lainnya menjadi false
        if ($request->is_cover && !$galeri->is_cover) {
            Galeri::where('artikel_id', $artikelId)->where('is_cover', true)->update(['is_cover' => false]);
        }

        $galeri->update([
            'judul_gambar' => $request->judul_gambar ?? $galeri->judul_gambar,
            'is_cover' => $request->is_cover ?? $galeri->is_cover,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? $galeri->urutan,
        ]);

        // Update urutan jika ada perubahan
        if ($request->has('urutan') && $request->urutan != $galeri->urutan) {
            $this->reorderGallery($artikelId);
        }

        return redirect()->route('galeri-list', $artikelId)
                ->with('success', 'Media berhasil diperbarui!');
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function post_delete(Request $request)
    {
        $galeri = Galeri::findOrFail($request->id);
        $artikelId = $galeri->artikel_id;

        // Hapus file dari storage
        if (Storage::disk('public')->exists($galeri->file_path)) {
            Storage::disk('public')->delete($galeri->file_path);
        }

        // Jika yang dihapus adalah cover, set cover lain jika ada
        if ($galeri->is_cover) {
            $newCover = Galeri::where('artikel_id', $artikelId)
                            ->where('id', '!=', $galeri->id)
                            ->orderBy('urutan')
                            ->first();
            if ($newCover) {
                $newCover->update(['is_cover' => true]);
            }
        }

        $galeri->delete();

        // Reorder setelah delete
        $this->reorderGallery($artikelId);

        return redirect()->route('galeri-list', $artikelId)
                ->with('success', 'Media berhasil dihapus!');
    }

    /**
     * Set a gallery item as cover.
     */
    public function post_set_cover(Request $request)
    {
        $galeri = Galeri::findOrFail($request->id);
        $artikelId = $galeri->artikel_id;

        // Update semua cover menjadi false
        Galeri::where('artikel_id', $artikelId)->update(['is_cover' => false]);

        // Set cover baru
        $galeri->update(['is_cover' => true]);

        return redirect()->route('galeri-list', $artikelId)
                ->with('success', 'Cover berhasil diubah!');
    }

    /**
     * Reorder gallery items.
     */
    private function reorderGallery($artikelId)
    {
        $galeris = Galeri::where('artikel_id', $artikelId)
                        ->orderBy('urutan')
                        ->get();

        $urutan = 1;
        foreach ($galeris as $item) {
            $item->update(['urutan' => $urutan++]);
        }
    }

    /**
     * Format file size.
     */
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
