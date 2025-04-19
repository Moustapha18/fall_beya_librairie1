@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold">📊 Tableau de bord</h2>

        <!-- Cartes en colonne avec icônes -->
        <div class="row">
            <!-- Commandes -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0 text-white" style="background-color: #007bff;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Commandes</h5>
                            <h3 class="fw-bold mb-0">{{ $totals['commandes'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chiffre d'affaires -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0 text-white" style="background-color: #28a745;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-euro-sign fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Chiffre d'affaires</h5>
                            <h3 class="fw-bold mb-0">{{ number_format($totals['revenu'], 2, ',', ' ') }} F CFA</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clients -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0 text-white" style="background-color: #17a2b8;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Clients</h5>
                            <h3 class="fw-bold mb-0">{{ $totals['clients'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diagramme -->
        <div class="card shadow mt-4">
            <div class="card-header bg-dark text-white">
                📈 Commandes par mois
            </div>
            <div class="card-body">
                <canvas id="commandesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('commandesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($commandesParMois)) !!},
                    datasets: [{
                        label: 'Commandes',
                        data: {!! json_encode(array_values($commandesParMois)) !!},
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
