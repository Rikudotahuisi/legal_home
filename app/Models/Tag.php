<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi many-to-many dengan Artikel
     * melalui tabel pivot 'artikeltag'
     */
    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'artikeltag', 'tag_id', 'artikel_id')
                    ->withTimestamps();
    }
}
