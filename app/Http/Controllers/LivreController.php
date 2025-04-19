<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::all();
        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        return view('livres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cheminImage = null;

        if ($request->hasFile('image')) {
            $cheminImage = $request->file('image')->store('livres', 'public');
        }

        Livre::create([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'categorie' => $request->categorie,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $cheminImage,
        ]);

        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès !');
    }

    public function show(string $id)
    {
        $livre = Livre::findOrFail($id);
        return view('livres.show', compact('livre'));
    }

    public function edit(string $id)
    {
        $livre = Livre::findOrFail($id);
        return view('livres.edit', compact('livre'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $livre = Livre::findOrFail($id);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }

            $livre->image = $request->file('image')->store('livres', 'public');
        }

        $livre->update([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'categorie' => $request->categorie,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $livre->image, // conserve l'image si non modifiée
        ]);

        return redirect()->route('livres.index')->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $livre = Livre::findOrFail($id);

        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }

        $livre->delete();
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès.');
    }
}
