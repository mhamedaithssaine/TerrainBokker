<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;
use App\Interfaces\PasswordResetRepositoryInterface;

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

        try {
            $user = $this->userRepository->getUserByEmail($request->email);
    
            if (!$user) {
                return back()->withErrors(['email' => 'Nous ne trouvons pas d\'utilisateur avec cette adresse e-mail.']);
            }
    
            $token = $this->passwordResetRepository->createToken($request->email);
    
            Log::info('Tentative d\'envoi d\'email de réinitialisation', [
                'email' => $request->email,
                'token' => $token
            ]);
    
            Mail::send('emails.reset-password', ['token' => $token, 'email' => $request->email], function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Réinitialisation de mot de passe');
            });
    
            return back()->with('status', 'Nous avons envoyé votre lien de réinitialisation par e-mail!');
        } catch (\Exception $e) {
            Log::error('Erreur d\'envoi d\'email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Une erreur est survenue lors de l\'envoi de l\'e-mail. Veuillez vérifier vos paramètres SMTP.']);
        }
    }
}
    

