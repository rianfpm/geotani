<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        if (isset($filters['search']) ? $filters['search'] : false) {
            return $query->where('nama', 'like', '%' . $filters['search'] . '%')->orWhere('deskripsi', 'like', '%' . $filters['search'] . '%');
        }
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}