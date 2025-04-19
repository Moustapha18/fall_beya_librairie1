<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistiqueController;
use Illuminate\Support\Facades\Mail;



// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail', function () {
    try {
        Mail::raw('Ceci est un test d\'envoi d\'email via Mailtrap.', function ($message) {
            $message->to('exemple@exemple.com') // Peu importe l'adresse ici, Mailtrap intercepte
            ->subject('📧 Test Mailtrap Laravel');
        });

        return '✅ Email envoyé avec succès ! Vérifie ta boîte Mailtrap.';
    } catch (\Exception $e) {
        Log::error('Erreur d\'envoi d\'email : '.$e->getMessage());
        return '❌ Échec de l\'envoi : ' . $e->getMessage();
    }
});


// Dashboard utilisateur connecté
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes accessibles à tous les utilisateurs connectés
Route::middleware('auth')->group(function () {
    // Gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes Client
Route::middleware(['auth', 'can:isClient'])->group(function () {
    Route::get('/catalogue', [CommandeController::class, 'catalogue'])->name('catalogue');
    Route::get('livre/{livre}', [CommandeController::class, 'detail'])->name('livre.detail');
    Route::post('commander', [CommandeController::class, 'store'])->name('commande.store');
    Route::get('mes-commandes', [CommandeController::class, 'mesCommandes'])->name('commande.mes');
    Route::post('/commander', [CommandeController::class, 'store'])->name('commande.store')->middleware(['auth', 'can:isClient']);
    Route::get('/commande/paiement/{commande}', [CommandeController::class, 'paiementForm'])->name('commande.paiement');
    Route::post('/commande/paiement/{commande}', [CommandeController::class, 'payer'])->name('commande.payer');
});

// Routes Gestionnaire
Route::middleware(['auth', 'can:isGestionnaire'])->group(function () {
    // CRUD Livres
    Route::resource('livres', LivreController::class);
    Route::get('commandes/payees', [CommandeController::class, 'payees'])->name('commandes.payees');
    Route::get('commandes/en-attente', [CommandeController::class, 'enAttente'])->name('commandes.enAttente');
    Route::get('commandes/export/pdf', [CommandeController::class, 'exportPdf'])->name('commandes.export.pdf');


    // Gestion des commandes
    Route::get('commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
    Route::put('commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.statut');
    Route::delete('commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
    Route::post('commandes/{commande}/payer', [CommandeController::class, 'payer'])->name('commandes.payer')->middleware(['auth', 'can:isGestionnaire']);
    Route::get('/commandes/{commande}/pdf', [CommandeController::class, 'exportPdf'])->name('commandes.pdf');

    // Statistiques
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques');
    Route::get('/statistiques/data', [StatistiqueController::class, 'data'])->name('statistiques.data');
});

require __DIR__.'/auth.php';
