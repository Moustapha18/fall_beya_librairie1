@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Bienvenue {{ Auth::user()->name }}</h2>

        @if(Auth::user()->isGestionnaire())
            <a href="{{ route('livres.index') }}" class="btn btn-primary">Gérer les livres</a>
            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Commandes clients</a>
        @elseif(Auth::user()->isClient())
            <a href="{{ route('catalogue') }}" class="btn btn-primary">Voir le catalogue</a>
            <a href="{{ route('commande.mes') }}" class="btn btn-secondary">Mes commandes</a>
        @endif
    </div>
@endsection
