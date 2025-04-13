<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name'];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,"role_user");
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class,"role_permission");
    }
}
