<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livre;
use App\Models\User;
use App\Notifications\ConfirmationCommande;
use App\Notifications\NouvelleCommande;
use App\Notifications\FactureEnvoyee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CommandeController extends Controller
{
    public function catalogue()
    {
        $livres = Livre::where('stock', '>', 0)->get();
        return view('commandes.catalogue', compact('livres'));
    }

    public function detail(Livre $livre)
    {
        return view('commandes.detail', compact('livre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $livre = Livre::findOrFail($request->livre_id);

        if ($livre->stock < $request->quantite) {
            return back()->with('error', 'Stock insuffisant.');
        }

        $commande = Commande::create([
            'user_id' => Auth::id(),
            'total' => $livre->prix * $request->quantite,
            'statut' => 'en attente',
        ]);

        $commande->livres()->attach($livre->id, [
            'quantite' => $request->quantite,
            'prix_unitaire' => $livre->prix,
        ]);

        $livre->decrement('stock', $request->quantite);

        // Envoi de confirmation au client
        Auth::user()->notify(new ConfirmationCommande($commande));

        // Notification aux gestionnaires
        $gestionnaires = User::where('role', 'gestionnaire')->get();
        Notification::send($gestionnaires, new NouvelleCommande($commande));

        return redirect()->route('commande.mes')->with('success', 'Commande passée avec succès.');
    }

    public function updateStatut(Request $request, Commande $commande)
    {
        $request->validate(['statut' => 'required']);

        $commande->statut = $request->statut;
        $commande->save();

        // Envoi de la facture PDF si expédiée
        if ($commande->statut === 'expédiée') {
            $commande->user->notify(new FactureEnvoyee($commande));
        }

        return back()->with('success', 'Statut mis à jour.');
    }

    public function exportPdf(Commande $commande)
    {
        $commande->load('user', 'livres');

        $pdf = Pdf::loadView('commandes.pdf', compact('commande'));
        return $pdf->download('commande_' . $commande->id . '.pdf');
    }


    public function mesCommandes()
    {
        $commandes = Auth::user()->commandes()->with('livres')->latest()->get();
        return view('commandes.mes', compact('commandes'));
    }

    public function index(Request $request)
    {
        $query = Commande::with('user');

        if ($request->filled('client')) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->client . '%'));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $commandes = $query->orderByDesc('created_at')->paginate(10);
        return view('commandes.admin.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        $commande->load('user', 'livres');
        return view('commandes.admin.show', compact('commande'));
    }

    public function exportPdf2()
    {
        $commandes = Commande::with('user')->latest()->get();
        $pdf = Pdf::loadView('commandes.admin.pdf', compact('commandes'));
        return $pdf->download('commandes.pdf');
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();
        return back()->with('success', 'Commande annulée.');
    }

    public function payees()
    {
        $commandes = Commande::where('statut', 'payée')->orderByDesc('created_at')->get();
        return view('commandes.admin.index', compact('commandes'));
    }

    public function enAttente()
    {
        $commandes = Commande::where('statut', 'en attente')->orderByDesc('created_at')->get();
        return view('commandes.admin.index', compact('commandes'));
    }

    public function payer(Commande $commande)
    {
        if ($commande->statut === 'payée') {
            return back()->with('error', 'Cette commande a déjà été payée.');
        }

        $commande->update(['statut' => 'payée']);
        return back()->with('success', 'Paiement enregistré avec succès.');
    }
}
