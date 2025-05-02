<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Terrain;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FeedbackRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = Category::all();
    
        
        $query = Terrain::with('categorie','tags');
    
     
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
    
 
        $terrainIds = $terrains->pluck('id');
    
       
        $reservations = Reservation::whereIn('terrain_id', $terrainIds) 
            ->where('date_debut', '>', Carbon::now()) 
            ->where('statut', 'confirmée') 
            ->where('payment_status', 'payé') 
            ->get(['id', 'terrain_id', 'date_debut', 'date_fin']); 
    
       
        $reservationsByTerrain = $reservations->groupBy('terrain_id');
    
       
        $feedbacks = Feedback::where('status', 'publier') 
            ->with('user') 
            ->latest() 
            ->get(); 
    
     
        return view('home', compact('terrains', 'reservations', 'categories', 'feedbacks'))
            ->with('reservations', $reservationsByTerrain);

        
    }

    public function storeFeedback(FeedbackRequest $request)
{
    Feedback::create([
        'user_id' => Auth::id(),
        'commentaire' => $request->commentaire,
        'note' => $request->note,
        'status' => 'cacher',
    ]);

    return redirect()->route('home')->with('success', 'Votre feedback a été soumis avec succès ! Il sera visible après modération.');
}

}
