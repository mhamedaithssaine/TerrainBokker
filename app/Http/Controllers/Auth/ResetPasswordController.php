<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\PasswordResetRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    
    private UserRepositoryInterface $userRepository;
    private PasswordResetRepositoryInterface $passwordResetRepository;

    public function __construct(UserRepositoryInterface $userRepository,PasswordResetRepositoryInterface $passwordResetRepository) {
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
      
    }

    /**
     * Display the password reset view for the given token
     */
    public function showResetForm(Request $request, $token = null)
    {

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email, 
        ]);
        
    }

    /**
     * Reset the given user's password
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required'
        ]);

        $passwordReset = $this->passwordResetRepository->findByToken($request->token);

        if (!$passwordReset || $passwordReset->email !== $request->email) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = $this->userRepository->getUserByEmail($request->email);

        if (!$user) {
            return back()->withErrors(['email' => 'Nous ne trouvons pas d\'utilisateur avec cette adresse e-mail.']);
        }

        $this->userRepository->updateUser($user->id, [
           
            'password' => $request->password
        ]);
      

        $this->passwordResetRepository->deleteToken($request->token);

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
