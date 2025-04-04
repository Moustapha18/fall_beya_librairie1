<?php

namespace App\Http\Controllers;

use App\Models\Livre; // Import manquant
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Livre::all();
        return view('livres.index', compact('livres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('livres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);


        Livre::create([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'categorie' => $request->categorie,
            'prix' => $request->prix,
            'stock' => $request->stock,
        ]);


        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livre = Livre::findOrFail($id);
        return view('livres.show', compact('livre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $livre = Livre::findOrFail($id); // Correction: récupérer un seul livre par son ID
        return view('livres.edit', compact('livre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $livre = Livre::findOrFail($id); // Correction: récupérer le livre avant de le mettre à jour
        $livre->update($request->all());
        return redirect()->route('livres.index')->with('success', 'Livre mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $livre = Livre::findOrFail($id); // Variable $livre manquante
        $livre->delete();
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès.');
    }
}
