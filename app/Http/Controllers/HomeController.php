<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terrains = Terrain::with('categorie')->paginate(3);

        $reservations = Reservation::whereIn('terrain_id', $terrains->pluck('id'))
            ->where('date_debut', '>=', Carbon::now())
            ->get(['terrain_id', 'date_debut', 'date_fin'])
            ->groupBy('terrain_id');
        return view ('home',compact('terrains','reservations'));

        
    }

}
