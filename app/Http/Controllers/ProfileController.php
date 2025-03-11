<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Affiche le profil de l'utilisateur.
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Affiche le formulaire d'édition du profil.
     */
    public function edit()
    {
        return view('profile.edit');
    }
}
