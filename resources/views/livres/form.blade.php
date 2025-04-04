@csrf

<div class="mb-3">
    <label for="titre" class="form-label">Titre</label>
    <input type="text" name="titre" class="form-control" id="titre" value="{{ old('titre', $livre->titre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="auteur" class="form-label">Auteur</label>
    <input type="text" name="auteur" class="form-control" id="auteur" value="{{ old('auteur', $livre->auteur ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="categorie" class="form-label">Catégorie</label>
    <input type="text" name="categorie" class="form-control" id="categorie" value="{{ old('categorie', $livre->categorie ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="prix" class="form-label">Prix (€)</label>
    <input type="number" step="0.01" min="0" name="prix" class="form-control" id="prix" value="{{ old('prix', $livre->prix ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" min="0" name="stock" class="form-control" id="stock" value="{{ old('stock', $livre->stock ?? '') }}" required>
</div>
