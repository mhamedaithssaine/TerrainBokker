<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileSportiveRequest;

class SportiveProfileController extends Controller
{


    public function show()
    {
        return view('sportive.profile.show');
    }



    public function edit()
    {
        return view('sportive.profile.edit');
    }


    public function update(UpdateProfileSportiveRequest $request)
    {
        $user = Auth::user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('sportive.profile')->with('success', 'Profil mis à jour avec succès.');
    }
}
