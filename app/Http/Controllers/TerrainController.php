<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Sponsor;
use App\Models\Terrain;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\TerrainRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateTerrainRequest;

class TerrainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terrains = Terrain::with([ 'categorie','tags'])->orderBy('created_at', 'desc')
        ->paginate(5);
        return view('terrains.index', compact('terrains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =Category::get();
        $tags = Tag::get();
        return view('terrains.create',compact('categories','tags'));
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
                'statut' => $request->statut,
                'adresse' => $request->adresse,
                'description' => $request->description ?: null,
            ];
    
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('terrains', 'public');
            }
            
            
          $terrain =  Terrain::create($data);
            if ($request->has('tag_ids')) {
                $terrain->tags()->sync($request->input('tag_ids'));
            }
    
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
        $terrain->load(['categorie', 'tags']); 
        return view('terrains.show',compact('terrain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terrain $terrain)
    {
        $categories = Category::all(); 
        $tags = Tag::all();     
        return view('terrains.edit', compact('terrain', 'categories', 'tags'));
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

            if ($request->has('tag_ids')) {
                $terrain->tags()->sync($request->input('tag_ids'));
            } else {
                $terrain->tags()->detach(); 
            }
    
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

            $reservationsCount = $terrain->reservations()
            ->where('date_fin', '>=', Carbon::now())
            ->count();

            if ($reservationsCount > 0) {
                return redirect()->back()->with('error', 'Ce terrain ne peut pas être supprimé car il est réservé par des clients.');
            }

            if ($terrain->photo) {
                Storage::disk('public')->delete($terrain->photo);
            }
            $terrain->tags()->detach();
            $terrain->delete();
    
            return redirect()->route('terrains.index')->with('success', 'Terrain supprime avec succes.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du terrain.');
        }
    }

    
}
