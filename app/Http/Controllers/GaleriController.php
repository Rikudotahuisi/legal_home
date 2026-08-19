<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GaleriController extends Controller
{
    /**
     * Display a listing of the gallery for an article.
     */
    public function view_list($artikelId)
    {
        $artikel = Artikel::with(['galeris', 'slides'])->findOrFail($artikelId);
        return view('galeri.list', compact('artikel'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function view_create($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        return view('galeri.create', compact('artikel'));
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
            'is_slide' => 'nullable|boolean', // ← TAMBAHKAN
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

        // ===== TAMBAHKAN: Jika dijadikan slide =====
        $slideUrutan = 0;
        if ($request->is_slide) {
            $slideUrutan = Galeri::where('artikel_id', $artikelId)->where('is_slide', true)->max('slide_urutan') ?? 0;
            $slideUrutan++;
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
            'is_slide' => $request->is_slide ?? false, // ← TAMBAHKAN
            'slide_urutan' => $slideUrutan, // ← TAMBAHKAN
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

        return view('galeri.show', compact('artikel', 'galeri'));
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function view_update($artikelId, $id)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $galeri = Galeri::where('artikel_id', $artikelId)->findOrFail($id);

        return view('galeri.update', compact('artikel', 'galeri'));
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
            'is_slide' => 'nullable|boolean', // ← TAMBAHKAN
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        // Jika dijadikan cover, update cover lainnya menjadi false
        if ($request->is_cover && !$galeri->is_cover) {
            Galeri::where('artikel_id', $artikelId)->where('is_cover', true)->update(['is_cover' => false]);
        }

        // ===== TAMBAHKAN: Logic untuk slide =====
        // Jika dijadikan slide (sebelumnya bukan slide)
        if ($request->is_slide && !$galeri->is_slide) {
            $slideUrutan = Galeri::where('artikel_id', $artikelId)
                                ->where('is_slide', true)
                                ->max('slide_urutan') ?? 0;
            $galeri->slide_urutan = $slideUrutan + 1;
        }

        // Jika dihapus dari slide (sebelumnya slide)
        if (!$request->is_slide && $galeri->is_slide) {
            $galeri->slide_urutan = 0;
            // Reorder slide yang tersisa
            $this->reorderSlides($artikelId);
        }

        $galeri->update([
            'judul_gambar' => $request->judul_gambar ?? $galeri->judul_gambar,
            'is_cover' => $request->is_cover ?? $galeri->is_cover,
            'is_slide' => $request->is_slide ?? $galeri->is_slide, // ← TAMBAHKAN
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

        // ===== TAMBAHKAN: Jika yang dihapus adalah slide, reorder ulang =====
        if ($galeri->is_slide) {
            $this->reorderSlides($artikelId);
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

    /**
     * Set a gallery item as slide (Toggle on/off)
     */
    public function post_set_slide(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:galeris,id',
        ]);

        $galeri = Galeri::findOrFail($request->id);
        $artikelId = $galeri->artikel_id;

        // Toggle is_slide
        $isSlide = !$galeri->is_slide;

        if ($isSlide) {
            // Jika dijadikan slide, cari urutan terakhir
            $lastOrder = Galeri::where('artikel_id', $artikelId)
                              ->where('is_slide', true)
                              ->max('slide_urutan') ?? 0;

            $galeri->update([
                'is_slide' => true,
                'slide_urutan' => $lastOrder + 1,
            ]);
        } else {
            // Jika dihapus dari slide
            $galeri->update([
                'is_slide' => false,
                'slide_urutan' => 0,
            ]);

            // Reorder slide yang tersisa
            $this->reorderSlides($artikelId);
        }

        return redirect()->route('galeri-list', $artikelId)
                ->with('success', $isSlide ? 'Foto berhasil ditambahkan ke slide!' : 'Foto dihapus dari slide!');
    }

    /**
     * Reorder slides (manual ordering via drag & drop)
     */
    public function post_reorder_slides(Request $request)
    {
        $request->validate([
            'artikel_id' => 'required|exists:artikels,id',
            'slides' => 'required|array',
            'slides.*.id' => 'required|exists:galeris,id',
            'slides.*.slide_urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->slides as $slide) {
            Galeri::where('id', $slide['id'])
                ->where('artikel_id', $request->artikel_id)
                ->update(['slide_urutan' => $slide['slide_urutan']]);
        }

        return redirect()->route('galeri-list', $request->artikel_id)
                ->with('success', 'Urutan slide berhasil diupdate!');
    }

    /**
     * Reorder slides (private method - auto reorder after delete/toggle)
     */
    private function reorderSlides($artikelId)
    {
        $slides = Galeri::where('artikel_id', $artikelId)
                    ->where('is_slide', true)
                    ->orderBy('slide_urutan')
                    ->get();

        $urutan = 1;
        foreach ($slides as $item) {
            $item->update(['slide_urutan' => $urutan++]);
        }
    }
}
