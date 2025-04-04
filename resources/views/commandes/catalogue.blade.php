@extends('adminlte::page')

@section('title', 'Catalogue')

@section('content')
    <h1>Catalogue des livres</h1>

    @foreach($livres as $livre)
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $livre->titre }}</h4>
                <p><strong>Auteur :</strong> {{ $livre->auteur }}</p>
                <p><strong>Catégorie :</strong> {{ $livre->categorie }}</p>
                <p><strong>Prix :</strong> {{ $livre->prix }} €</p>
                <p><strong>Stock :</strong> {{ $livre->stock }}</p>
                <a href="{{ route('livre.detail', $livre) }}" class="btn btn-primary">Commander</a>
            </div>
        </div>
    @endforeach
@endsection
