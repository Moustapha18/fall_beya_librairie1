<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        // Totaux généraux
        $totals = [
            'commandes' => Commande::count(),
            'revenu' => Commande::where('statut', 'payée')->sum('total'),
            'clients' => User::where('role', 'client')->count(),
        ];

        // Commandes par mois (1 à 12)
        $commandesParMois = Commande::selectRaw('EXTRACT(MONTH FROM created_at) as mois, COUNT(*) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois')
            ->toArray();

        // Formatage des mois manquants (affiche tous les mois même à 0)
        $commandesCompletes = [];
        for ($i = 1; $i <= 12; $i++) {
            $commandesCompletes[$i] = $commandesParMois[$i] ?? 0;
        }

        return view('statistiques.index', [
            'totals' => $totals,
            'commandesParMois' => $commandesCompletes
        ]);
    }
}
