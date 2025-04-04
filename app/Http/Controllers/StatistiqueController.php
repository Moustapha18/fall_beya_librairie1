<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function index()
    {
        return view('statistiques.index');
    }

    public function data()
    {
        // Commandes par mois (avec EXTRACT pour PostgreSQL)
        $commandesParMois = Commande::selectRaw('EXTRACT(MONTH FROM created_at) as mois, COUNT(*) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois');

        // Recettes des 7 derniers jours
        $recettesParJour = Commande::selectRaw('DATE(created_at) as jour, SUM(total) as total')
            ->where('statut', 'payée')
            ->groupBy('jour')
            ->orderBy('jour', 'desc')
            ->take(7)
            ->get();

        // Livres vendus par catégorie par mois (adapté à PostgreSQL)
        $livresVendus = DB::table('commande_livres')
            ->join('commandes', 'commande_livres.commande_id', '=', 'commandes.id')
            ->join('livres', 'commande_livres.livre_id', '=', 'livres.id')
            ->selectRaw('EXTRACT(MONTH FROM commandes.created_at) as mois, livres.categorie, SUM(commande_livres.quantite) as total')
            ->groupBy('mois', 'livres.categorie')
            ->orderBy('mois')
            ->get();


        // Formatage des données
        $parCategorie = [];
        foreach ($livresVendus as $row) {
            $parCategorie[$row->categorie]['mois'][$row->mois] = $row->total;
        }

        return response()->json([
            'commandesParMois' => $commandesParMois,
            'recettesParJour' => $recettesParJour,
            'livresParCategorie' => $parCategorie,
        ]);
    }
}
