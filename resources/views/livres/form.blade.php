<form method="POST" action="{{ isset($livre) ? route('livres.update', $livre->id) : route('livres.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($livre))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="titre">📚 Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre', $livre->titre ?? '') }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="auteur">✍️ Auteur</label>
            <input type="text" name="auteur" class="form-control" value="{{ old('auteur', $livre->auteur ?? '') }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="categorie">🗂️ Catégorie</label>
            <input type="text" name="categorie" class="form-control" value="{{ old('categorie', $livre->categorie ?? '') }}" required>
        </div>

        <div class="col-md-3 mb-3">
            <label for="prix">💶 Prix (FCFA)</label>
            <input type="number" step="0.01" min="0" name="prix" class="form-control" value="{{ old('prix', $livre->prix ?? '') }}" required>
        </div>

        <div class="col-md-3 mb-3">
            <label for="stock">📦 Stock</label>
            <input type="number" min="0" name="stock" class="form-control" value="{{ old('stock', $livre->stock ?? '') }}" required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="image">🖼️ Image du livre</label>
            <input type="file" name="image" class="form-control">
        </div>

        @if(!empty($livre->image))
            <div class="col-md-4 mb-3">
                <img src="{{ asset('storage/' . $livre->image) }}"
                     class="img-thumbnail img-hover"
                     alt="Image du livre" width="150">
            </div>
        @endif
        @if(!empty($livre->image))
            <div class="col-md-4 mb-3">
                <img src="{{ asset('storage/' . $livre->image) }}"
                     class="img-thumbnail img-hover"
                     alt="Image du livre" width="150">
            </div>
        @endif

    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
        <a href="{{ route('livres.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>
</form>
<style>
    .img-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .img-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
</style>
