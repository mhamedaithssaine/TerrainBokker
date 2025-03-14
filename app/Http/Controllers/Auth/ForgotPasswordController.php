<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\PasswordResetRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private PasswordResetRepositoryInterface $passwordResetRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordResetRepositoryInterface $passwordResetRepository
    ) {
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
       
    }

    /**
     * Show the form to request a password reset link
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a reset link to the given user
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = $this->userRepository->getUserByEmail($request->email);

        if (!$user) {
            return back()->withErrors(['email' => 'Nous ne trouvons pas d\'utilisateur avec cette adresse e-mail.']);
        }

        $token = $this->passwordResetRepository->createToken($request->email);

        // Envoyer l'e-mail
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return back()->with('status', 'Nous avons envoyé votre lien de réinitialisation par e-mail!');
    }
    
}
