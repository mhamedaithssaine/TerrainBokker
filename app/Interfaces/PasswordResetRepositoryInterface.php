<?php

namespace App\Interfaces;

interface PasswordResetRepositoryInterface
{
    public function createToken($email);
    public function findByToken($token);
    public function deleteToken($token);
}