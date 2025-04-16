<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Terrain;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Terrain::with('categorie');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('adresse', 'like', "%{$search}%");
            });
        }

        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->input('categorie'));
        }

        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->input('prix_max'));
        }

        $terrains = $query->paginate(3);

        $reservations = Reservation::whereIn('terrain_id', $terrains->pluck('id'))
            ->where('date_fin', '>=', Carbon::now())
            ->get(['terrain_id', 'date_debut', 'date_fin'])
            ->groupBy('terrain_id');
        return view ('home',compact('terrains','reservations','categories'));

        
    }

}
