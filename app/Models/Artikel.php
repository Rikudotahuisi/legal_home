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
}
