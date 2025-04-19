@extends('adminlte::page')

@section('title', 'Liste des livres')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>📚 Gestion des livres</h1>
        <a href="{{ route('livres.create') }}" class="btn btn-success">
            ➕ Ajouter un livre
        </a>
    </div>
@endsection

@section('content')
    <div class="row mt-3">
        @foreach($livres as $livre)
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    @if($livre->image)
                        <img src="{{ asset('storage/' . $livre->image) }}" class="card-img-top" alt="Image de {{ $livre->titre }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200.png?text=Pas+d'image" class="card-img-top" alt="Aucune image">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $livre->titre }}</h5>
                        <p class="card-text"><strong>Auteur :</strong> {{ $livre->auteur }}</p>
                        <p class="card-text"><strong>Catégorie :</strong> {{ $livre->categorie }}</p>
                        <p class="card-text"><strong>Prix :</strong> {{ number_format($livre->prix, 2, ',', ' ') }} FCFA</p>
                        <p class="card-text"><strong>Stock :</strong> {{ $livre->stock }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-sm btn-primary">✏️ Modifier</a>

                        <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑 Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
