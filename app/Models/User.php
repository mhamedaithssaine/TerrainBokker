<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Vérifie si l'utilisateur a un rôle spécifique
    public function hasRole($role)
    {
        return $this->roles->where('name', $role)->isNotEmpty();   
    }

     // Vérifie si l'utilisateur a une permission spécifique
     public function hasPermission($permission)
     {
         foreach ($this->roles as $role) {
             if ($role->permissions->contains('name', $permission)) {
                 return true;
             }
         }
         return false;
     }


     public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'sportive_id');
    }
}
