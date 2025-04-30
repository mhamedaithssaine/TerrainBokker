@extends('layouts.app')

@section('title', 'TerrainBokker - Tableau de bord gestionnaire')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tableau de bord gestionnaire</h1>
    <!--pour les statique-->
    <div id="statique-card">

    </div>

      <!--pour les recent-reservations -->
    <div id="recent-reservations-table"></div>
    <!--pour les feedback-recents cacher-->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div id="feedback-recents">
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route("components.feedbackrecents") }}')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('feedback-recents').innerHTML = data;
                })
                .catch(error => console.error('Erreur lors du chargement des feedbacks:', error));
        });

        //popur les statique-card
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route("components.stats-card") }}')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('statique-card').innerHTML = data;
                })
                .catch(error => console.error('Erreur lors du chargement des feedbacks:', error));


            // Fetch Recent Reservations
            fetch('{{ route("components.recent-reservations") }}')
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('recent-reservations-table').innerHTML = data;
                            })
                            .catch(error => console.error('Erreur lors du chargement des réservations:', error));          
        });


        



    </script>
@endsection