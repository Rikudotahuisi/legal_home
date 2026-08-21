<?php
// app/Models/Tag.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug', 
    ];
     // ===== AUTO GENERATE SLUG =====
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    // ===== RELASI KE ARTIKEL - PAKAI TABEL artikeltag =====
    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'artikeltag', 'tag_id', 'artikel_id');
    }
}