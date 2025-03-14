<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUserByEmail($email);
    public function createUser(array $userDetails);
    public function updateUser($id, array $userDetails);
    public function deleteUser($id);
}
