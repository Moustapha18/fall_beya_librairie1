@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">📊 Statistiques</h1>

        <div class="mb-5">
            <canvas id="commandesChart"></canvas>
        </div>

        <div class="mb-5">
            <canvas id="recettesChart"></canvas>
        </div>

        <div class="mb-5">
            <canvas id="categoriesChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch("{{ route('statistiques.data') }}")
            .then(response => response.json())
            .then(data => {
                // Graphique des commandes par mois
                new Chart(document.getElementById('commandesChart'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data.commandesParMois),
                        datasets: [{
                            label: 'Commandes par mois',
                            data: Object.values(data.commandesParMois),
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        }]
                    }
                });

                // Graphique des recettes par jour
                new Chart(document.getElementById('recettesChart'), {
                    type: 'line',
                    data: {
                        labels: data.recettesParJour.map(r => r.jour),
                        datasets: [{
                            label: 'Recettes (7 derniers jours)',
                            data: data.recettesParJour.map(r => r.total),
                            backgroundColor: 'rgba(255, 99, 132, 0.5)'
                        }]
                    }
                });

                // Graphique des livres vendus par catégorie
                const categories = Object.keys(data.livresParCategorie);
                const moisLabels = [...new Set(categories.flatMap(cat => Object.keys(data.livresParCategorie[cat].mois)))];

                const datasets = categories.map(categorie => ({
                    label: categorie,
                    data: moisLabels.map(m => data.livresParCategorie[categorie].mois[m] || 0),
                    backgroundColor: `rgba(${Math.random()*255}, ${Math.random()*255}, ${Math.random()*255}, 0.6)`
                }));

                new Chart(document.getElementById('categoriesChart'), {
                    type: 'bar',
                    data: {
                        labels: moisLabels,
                        datasets: datasets
                    }
                });
            });
    </script>
@endsection
