<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\WelcomeUserMail;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserUpdateRequest;

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
    public function show(User $user)
    {
        $roles = Role::all();
        return view('users.show',compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validatedData = $request->validated();
    
        if (is_null($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        
        $user->update($validatedData);
        

    
    if ($request->hasFile('profile_photo')) {

        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
        $user->save();

    }
   

    if ($request->has('role')) {
        $user->roles()->detach();
        
        $role = Role::where('name', $request->input('role'))->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }
    }


    return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimer avec succes');
    }

      /**
     * Update role resource from storage.
     */

    public function updateRole(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|exists:roles,name'
    ]);
    
    
    $user->roles()->detach();
    $role = Role::where('name', $request->role)->first();
    $user->roles()->attach($role);

    
    return back()->with('success', 'Role mis à jour avec succes');
}
}
