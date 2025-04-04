
@extends('adminlte::page')

@section('title', 'Détail du livre')

@section('content_header')
    <h1>{{ $livre->titre }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Auteur :</strong> {{ $livre->auteur }}</p>
            <p><strong>Catégorie :</strong> {{ $livre->categorie }}</p>
            <p><strong>Description :</strong> {{ $livre->description }}</p>
            <p><strong>Prix :</strong> {{ $livre->prix }} €</p>
            <p><strong>Stock :</strong> {{ $livre->stock }}</p>

            <form method="POST" action="{{ route('commande.store') }}">
                @csrf
                <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                <div class="form-group">
                    <label>Quantité</label>
                    <input type="number" name="quantite" class="form-control" value="1" min="1" max="{{ $livre->stock }}">
                </div>
                <button type="submit" class="btn btn-success mt-2">Passer la commande</button>
            </form>
        </div>
    </div>
@endsection
