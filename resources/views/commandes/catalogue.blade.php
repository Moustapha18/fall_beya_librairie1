@extends('adminlte::page')

@section('title', 'Catalogue')

@section('content')
    <h1 class="mb-4">📚 Catalogue des livres</h1>

    <div class="row">
        @foreach($livres as $livre)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($livre->image)
                        <img src="{{ asset('storage/' . $livre->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image de {{ $livre->titre }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $livre->titre }}</h5>
                        <p class="card-text"><strong>Auteur :</strong> {{ $livre->auteur }}</p>
                        <p class="card-text"><strong>Catégorie :</strong> {{ $livre->categorie }}</p>
                        <p class="card-text"><strong>Prix :</strong> {{ number_format($livre->prix, 2, ',', ' ') }} F CFA</p>
                        <p class="card-text"><strong>Stock :</strong> {{ $livre->stock }}</p>
                        <a href="{{ route('livre.detail', $livre) }}" class="btn btn-primary w-100">🛒 Commander</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
