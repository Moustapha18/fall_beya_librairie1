
@extends('adminlte::page')

@section('title', 'Mes commandes')

@section('content_header')
    <h1>Mes commandes</h1>
@endsection

@section('content')
    @foreach($commandes as $commande)
        <div class="card mb-3">
            <div class="card-header">
                Commande #{{ $commande->id }} — Statut : <strong>{{ ucfirst($commande->statut) }}</strong>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($commande->livres as $livre)
                        <li>
                            {{ $livre->titre }} — {{ $livre->pivot->quantite }} x {{ $livre->pivot->prix_unitaire }} €
                        </li>
                    @endforeach
                </ul>
                <p><strong>Total :</strong> {{ $commande->total }} €</p>
            </div>
        </div>
    @endforeach
@endsection
