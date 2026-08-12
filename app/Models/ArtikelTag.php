<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelTag extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'artikeltag';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'artikel_id',
        'tag_id',
    ];

    /**
     * Relasi ke Artikel
     */
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }

    /**
     * Relasi ke Tag
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
