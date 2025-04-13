<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\UserRepositoryInterface;

class RegisterController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
       
    }

    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $sportiveRole = Role::where('name', 'sportive')->first();


        $user = $this->userRepository->createUser([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);


        if ($sportiveRole) {
            $user->roles()->attach($sportiveRole);
        }

        Auth::login($user);

        return redirect()->route('login');
    }
}

