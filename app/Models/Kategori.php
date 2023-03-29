<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function video()
    {
        return $this->hasMany(Video::class);
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}