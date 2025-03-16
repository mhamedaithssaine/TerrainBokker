<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Terrain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'photo',
        'prix',
        'sponsor_id',
        'categorie_id',
        'statut',
        'adresse',
    ];

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }
}
