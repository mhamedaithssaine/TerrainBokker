<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'terrain_id',
        'sportive_id',
        'date_debut',
        'date_fin',
        'statut',
    ];


    public function terrain()
    {
        return $this->belongsTo(Terrain::class, 'terrain_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'sportive_id');
    }
}
