<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function createUser(array $userDetails)
    {
        $userDetails['password'] = Hash::make($userDetails['password']);
        return User::create($userDetails);
    }

    public function updateUser($id, array $userDetails)
    {
        $user = User::findOrFail($id);
        
        if (isset($userDetails['password'])) {
            $userDetails['password'] = Hash::make($userDetails['password']);
        }
        
        $user->update($userDetails);
        return $user;
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }
}