<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\WelcomeUserMail;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(6);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request )
    {

                $photoPath = null;
                if ($request->hasFile('profile_photo')) {
                    $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
                }
                 $password = $request->password;
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make( $password ),	
                    'profile_photo' => $photoPath,
                ]);

                $role = Role::where('name', $request->role)->first();
                if ($role) {
                    $user->roles()->attach($role->id);
                }
 
                Mail::to($user->email)->send(new WelcomeUserMail($user,$password));
 
                return redirect()->route('users.index')->with('success', 'Utilisateur ajouter avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
