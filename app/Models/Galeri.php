<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galeris';

    protected $fillable = [
        'artikel_id',
        'judul_gambar',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'tipe_media',
        'is_cover',
        'is_slide',
        'slide_urutan',
        'urutan',
        'keterangan',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
        'is_slide' => 'boolean',
        'urutan' => 'integer',
        'slide_urutan' => 'integer',
    ];

    /**
     * Relasi ke Artikel (belongs to / one to many)
     */
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }

    /**
     * Scope untuk mendapatkan cover/thumbnail
     */
    public function scopeCover($query)
    {
        return $query->where('is_cover', true);
    }

    /**
     * Scope untuk gambar saja
     */
    public function scopeGambar($query)
    {
        return $query->where('tipe_media', 'gambar');
    }

    /**
     * Scope untuk video saja
     */
    public function scopeVideo($query)
    {
        return $query->where('tipe_media', 'video');
    }

    /**
     * Scope untuk diurutkan
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Accessor untuk full URL file
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

     public function scopeSlide($query)
    {
        return $query->where('is_slide', true)
                    ->orderBy('slide_urutan', 'asc');
    }

    /**
     * Accessor untuk icon berdasarkan tipe file
     */
    public function getIconAttribute()
    {
        $icons = [
            'jpg' => 'fa-image',
            'jpeg' => 'fa-image',
            'png' => 'fa-image',
            'gif' => 'fa-image',
            'svg' => 'fa-image',
            'mp4' => 'fa-video',
            'avi' => 'fa-video',
            'mov' => 'fa-video',
            'pdf' => 'fa-file-pdf',
            'doc' => 'fa-file-word',
            'docx' => 'fa-file-word',
        ];

        return $icons[$this->file_type] ?? 'fa-file';
    }
}
