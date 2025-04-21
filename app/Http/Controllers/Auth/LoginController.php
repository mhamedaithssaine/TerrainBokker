<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

     
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the authentication attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = $this->userRepository->getUserByEmail($request->email);


        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->put('user_id', $user->id); 
            $request->session()->put('name', $user->name);   
    
            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard.index');
            }
            return redirect()->route('home');
        }
    
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget(['user_id','name']);
        $request->session()->regenerate();
        return redirect('/');
    }
}