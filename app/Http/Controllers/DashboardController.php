<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     /**
     * Affiche le tableau de bord principal.
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Affiche la liste des réservations.
     */
   public function bookings()
    {
        // Exemple de données de réservations (à remplacer par une requête à la base de données)
        $bookings = [
            [
                'id' => 1,
                'client' => 'Michel Laurent',
                'email' => 'michel@example.com',
                'terrain' => 'Terrain Football 5',
                'date' => '2025-03-03',
                'heure_debut' => '18:00',
                'heure_fin' => '19:30',
                'statut' => 'confirmé', // confirmé, en attente, annulé
                'montant' => '75 €',
            ],
            [
                'id' => 2,
                'client' => 'Sarah Gibran',
                'email' => 'sarah@example.com',
                'terrain' => 'Tennis Court 2',
                'date' => '2025-03-03',
                'heure_debut' => '14:00',
                'heure_fin' => '15:30',
                'statut' => 'en attente',
                'montant' => '45 €',
            ],
            [
                'id' => 3,
                'client' => 'Jean Durand',
                'email' => 'jean@example.com',
                'terrain' => 'Basketball Court',
                'date' => '2025-03-02',
                'heure_debut' => '19:00',
                'heure_fin' => '20:00',
                'statut' => 'confirmé',
                'montant' => '60 €',
            ],
        ];

        // Passer les réservations à la vue
        return view('dashboard.bookings', compact('bookings'));
    }

    /**
     * Affiche les disponibilités des terrains.
     */
    public function availabilities()
    {
        // Exemple de données de disponibilités (à remplacer par une requête à la base de données)
        $availabilities = [
            [
                'id' => 1,
                'terrain' => 'Terrain Football 5',
                'date' => '2025-03-03',
                'heure_debut' => '18:00',
                'heure_fin' => '19:30',
                'statut' => 'disponible', // disponible, réservé, partiellement réservé
            ],
            [
                'id' => 2,
                'terrain' => 'Tennis Court 2',
                'date' => '2025-03-03',
                'heure_debut' => '14:00',
                'heure_fin' => '15:30',
                'statut' => 'réservé',
            ],
            [
                'id' => 3,
                'terrain' => 'Basketball Court',
                'date' => '2025-03-02',
                'heure_debut' => '19:00',
                'heure_fin' => '20:00',
                'statut' => 'partiellement réservé',
            ],
        ];

        // Passer les disponibilités à la vue
        return view('dashboard.availabilities', compact('availabilities'));
    }

    /**
     * Affiche la liste des terrains.
     */
    // Exemple de données de terrains (à remplacer par une requête à la base de données)
 

    /**
     * Affiche les paiements.
     */
    public function payments()
    {
        // Exemple de données de paiements (à remplacer par une requête à la base de données)
        $payments = [
            [
                'id' => 1,
                'client' => 'Michel Laurent',
                'email' => 'michel@example.com',
                'montant' => '75 €',
                'date' => '2025-03-03',
                'statut' => 'payé', // payé, en attente, annulé
            ],
            [
                'id' => 2,
                'client' => 'Sarah Gibran',
                'email' => 'sarah@example.com',
                'montant' => '45 €',
                'date' => '2025-03-03',
                'statut' => 'en attente',
            ],
            [
                'id' => 3,
                'client' => 'Jean Durand',
                'email' => 'jean@example.com',
                'montant' => '60 €',
                'date' => '2025-03-02',
                'statut' => 'annulé',
            ],
        ];

        // Passer les paiements à la vue
        return view('dashboard.payments', compact('payments'));
    }

    /**
     * Affiche les paramètres.
     */
    public function settings()
    {
        // Exemple de données de paramètres (à remplacer par une requête à la base de données)
        $settings = [
            'notifications' => true, // Activer/désactiver les notifications
            'theme' => 'light', // Thème (light/dark)
            'language' => 'fr', // Langue (fr/en)
        ];

        // Passer les paramètres à la vue
        return view('dashboard.settings', compact('settings'));
    }

    /**
     * Met à jour les paramètres.
     */
    public function updateSettings(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'notifications' => 'sometimes|boolean',
            'theme' => 'sometimes|in:light,dark',
            'language' => 'sometimes|in:fr,en',
        ]);

        // Enregistrement des paramètres (exemple : dans la base de données ou une session)
        // Ici, nous utilisons une session pour stocker temporairement les paramètres
        session([
            'notifications' => $request->input('notifications', false),
            'theme' => $request->input('theme', 'light'),
            'language' => $request->input('language', 'fr'),
        ]);

        // Redirection avec un message de succès
        return redirect()->route('dashboard.settings')->with('success', 'Paramètres mis à jour avec succès !');
    }

     /**
     * Affiche la page des avis clients.
     */
    public function reviews()
    {
        // Récupérer les avis clients depuis la base de données (exemple)
        $reviews = [
            [
                'id' => 1,
                'user' => 'Lucas Girard',
                'rating' => 5,
                'comment' => 'Terrain en parfait état, vestiaires propres. Je recommande !',
                'date' => '2025-03-01',
            ],
            [
                'id' => 2,
                'user' => 'Anne Moreau',
                'rating' => 4,
                'comment' => 'Bon terrain, éclairage un peu faible en soirée.',
                'date' => '2025-02-28',
            ],
            [
                'id' => 3,
                'user' => 'Thomas Dubois',
                'rating' => 4.5,
                'comment' => 'Excellent service, réservation facile et personnel très accueillant !',
                'date' => '2025-02-27',
            ],
        ];

        // Passer les avis à la vue
        return view('dashboard.reviews', compact('reviews'));
    }


 

    /**
     * Enregistre un nouveau terrain.
     */
    public function storeTerrain(Request $request)
    {
        // Validation des données du formulaire
       

        // Redirection avec un message de succès
        return redirect()->route('dashboard.terrains')->with('success', 'Terrain ajouté avec succès !');
    }
}

