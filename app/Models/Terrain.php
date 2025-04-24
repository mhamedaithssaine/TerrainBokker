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
        'categorie_id',
        'statut',
        'adresse',
    ];

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_terrain');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
