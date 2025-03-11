<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
     /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Affiche le formulaire d'inscription.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    /**
     * Traite l'inscription.
     */
    public function register(Request $request)
    {
        // Validation des données du formulaire
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        //     'terms' => 'required',
        // ]);

        // Création de l'utilisateur
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // Redirection vers la page de connexion avec un message de succès
        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Connectez-vous !');
    }

    /**
     * Affiche le formulaire de mot de passe oublié.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Affiche le formulaire de réinitialisation du mot de passe.
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }



}
