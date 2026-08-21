<?php
// app/Models/Artikel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    // ===== Tentukan nama tabel =====
    protected $table = 'artikels';  // <-- UBAH KE artikels

    protected $fillable = [
        'artikeltitle',
        'artikelcontent',
        'slug',
        'image',
        'created_by',
    ];

    protected $dates = ['deleted_at'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artikeltag', 'artikel_id', 'tag_id');
    }
}