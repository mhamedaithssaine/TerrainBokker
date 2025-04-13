<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTerrainRequest;
use App\Models\Sponsor;
use App\Models\Terrain;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TerrainRequest;
use Illuminate\Support\Facades\Storage;

class TerrainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terrains = Terrain::with(['sponsor', 'categorie'])->orderBy('created_at', 'desc')
        ->paginate(5);
        return view('terrains.index', compact('terrains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =Category::get();
        $sponsors = Sponsor::get();
        return view('terrains.create',compact('categories','sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TerrainRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'categorie_id' => $request->categorie_id,
                'prix' => $request->prix,
                'sponsor_id' => $request->sponsor_id ?: null,
                'statut' => $request->statut,
                'adresse' => $request->adresse,
                'description' => $request->description ?: null,
            ];
    
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('terrains', 'public');
            }
            
            
            Terrain::create($data);
    
            return redirect()->route('terrains.index')->with('success', 'Terrain créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du terrain.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Terrain  $terrain)
    {
        $terrain->load(['categorie', 'sponsor']); 
        return view('terrains.show',compact('terrain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terrain $terrain)
    {
        $categories = Category::all(); 
        $sponsors = Sponsor::all();     
        return view('terrains.edit', compact('terrain', 'categories', 'sponsors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTerrainRequest $request, Terrain $terrain)
    {
        try {
    
            $data = [
                'name' => $request->name,
                'categorie_id' => $request->categorie_id,
                'prix' => $request->prix,
                'sponsor_id' => $request->sponsor_id ?: null,
                'statut' => $request->statut,
                'adresse' => $request->adresse,
                'description' => $request->description ?: null,
            ];
    
            if ($request->hasFile('photo')) {
                if ($terrain->photo) {
                    Storage::disk('public')->delete($terrain->photo);
                }
                $data['photo'] = $request->file('photo')->store('terrains', 'public');
            }
    
            $terrain->update($data);
    
            return redirect()->route('terrains.index')->with('success', 'Terrain mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du terrain.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terrain  $terrain)
    {
        try {
            if ($terrain->photo) {
                Storage::disk('public')->delete($terrain->photo);
            }
    
            $terrain->delete();
    
            return redirect()->route('terrains.index')->with('success', 'Terrain supprime avec succes.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du terrain.');
        }
    }

    
}
