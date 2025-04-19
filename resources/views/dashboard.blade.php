@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="text-center mb-4">
            <img src="{{ asset('images/dashboard_banner.jpg') }}" class="img-fluid rounded shadow-sm mb-3" alt="Bienvenue" style="max-height: 250px;">
            <h2 class="fw-bold">👋 Bienvenue {{ Auth::user()->name }}</h2>
            <p class="text-muted">Nous sommes ravis de vous retrouver sur la plateforme 📚</p>
        </div>

        <div class="row justify-content-center">
            @if(Auth::user()->isGestionnaire())
                <div class="col-md-4 mb-3">
                    <a href="{{ route('livres.index') }}" class="btn btn-lg btn-primary w-100 shadow-sm">
                        <i class="fas fa-book me-2"></i> Gérer les livres
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('commandes.index') }}" class="btn btn-lg btn-secondary w-100 shadow-sm">
                        <i class="fas fa-clipboard-list me-2"></i> Commandes clients
                    </a>
                </div>
            @elseif(Auth::user()->isClient())
                <div class="col-md-4 mb-3">
                    <a href="{{ route('catalogue') }}" class="btn btn-lg btn-primary w-100 shadow-sm">
                        <i class="fas fa-book-open me-2"></i> Voir le catalogue
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('commande.mes') }}" class="btn btn-lg btn-secondary w-100 shadow-sm">
                        <i class="fas fa-box-open me-2"></i> Mes commandes
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
