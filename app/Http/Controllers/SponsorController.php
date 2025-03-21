<?php

namespace App\Http\Controllers;

use App\Http\Requests\SponsorRequest;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Affiche la liste des sponsors.
     */
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('sponsors.index', compact('sponsors'));
    }

    /**
     * Affiche le formulaire de création d'un sponsor.
     */
    public function create()
    {
        return view('sponsors.create');
    }


    /**
     * Enregistre un nouveau sponsor dans la base de données.
     */

    public function store(SponsorRequest $request)
    {



        $logoPath = $request->file('logo')->store('sponsors', 'public');

        Sponsor::create([
            'name' => $request->name,
            'logo' => $logoPath,
        ]);

        return redirect()->route('sponsors.index')->with('success', 'Sponsor crée avec succes.');
    }

    /**
     * Affiche le formulaire de modification d'un sponsor.
     */
    public function edit(Sponsor $sponsor)
    {
        return view('sponsors.edit', compact('sponsor'));
    }

    /**
     * Met à jour un sponsor dans la base de données.
     */

    public function update(SponsorRequest $request, Sponsor $sponsor)
    {
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('sponsors', 'public');
            $sponsor->logo = $logoPath;
        }

        $sponsor->name = $request->name;
        $sponsor->save();

        return redirect()->route('sponsors.index')->with('success', 'Sponsor mis a jour avec succes.');
    }

    /**
     * Supprime un sponsor de la base de données.
     *
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsors.index')->with('success', 'Sponsor supprimé avec succes.');
    }



}

