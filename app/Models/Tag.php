<?php

namespace App\Models;

use App\Models\Terrain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $table = "tags";

    protected $fillable = [
         'name',
    ];

    public function terrains()
    {
        return $this->belongsToMany(Terrain::class, 'tag_terrain');
    }
}
