<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'artikels';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'artikeltitle',
        'artikelcontent',
        'slug',
        'created_by',
    ];

    /**
     * Relasi many-to-many dengan Tag
     * melalui tabel pivot 'artikeltag'
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artikeltag', 'artikel_id', 'tag_id')
                    ->withTimestamps();
    }

    /**
     * Relasi ke User (creator)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi one-to-many ke Galeri
     */
    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'artikel_id')
                    ->orderBy('urutan', 'asc');
    }

    /**
     * Relasi ke cover/thumbnail artikel
     */
    public function cover()
    {
        return $this->hasOne(Galeri::class, 'artikel_id')
                    ->where('is_cover', true);
    }

    public function slides()
    {
        return $this->hasMany(Galeri::class, 'artikel_id')
                    ->where('is_slide', true)
                    ->orderBy('slide_urutan', 'asc');
    }

    /**
     * Relasi ke gambar saja
     */
    public function gambar()
    {
        return $this->hasMany(Galeri::class, 'artikel_id')
                    ->where('tipe_media', 'gambar')
                    ->orderBy('urutan', 'asc');
    }

    /**
     * Relasi ke video saja
     */
    public function video()
    {
        return $this->hasMany(Galeri::class, 'artikel_id')
                    ->where('tipe_media', 'video')
                    ->orderBy('urutan', 'asc');
    }

    public function getHasSlideAttribute()
    {
        return $this->slides()->count() > 0;
    }

    /**
     * Accessor untuk mendapatkan URL cover
     */
    public function getCoverUrlAttribute()
    {
        $cover = $this->cover;
        return $cover ? $cover->file_url : asset('images/no-image.png');
    }
}
