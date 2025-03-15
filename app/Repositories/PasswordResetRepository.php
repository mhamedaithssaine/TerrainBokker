<?php

namespace App\Repositories;

use App\Interfaces\PasswordResetRepositoryInterface;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{                                        
    public function createToken($email)
    {
        $token = Str::random(60);
        
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => now()
            ]
        );
        
        return $token;
    }

    public function findByToken($token)
    {
        return DB::table('password_reset_tokens')->where('token', $token)->first();
    }

    public function deleteToken($token)
    {
        return DB::table('password_reset_tokens')->where('token', $token)->delete();
    }

    public function deleteExisting($email){
          return DB::table('password_reset_tokens')->where('email',$email)->delete();
    }
}
