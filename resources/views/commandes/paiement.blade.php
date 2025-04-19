@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                💳 Paiement de la commande n°{{ $commande->id }}
            </div>
            <div class="card-body">
                <p class="fs-5">💰 <strong>Montant à régler :</strong>
                    <span class="text-success fw-bold">{{ number_format($commande->total, 2, ',', ' ') }} €</span>
                </p>

                <form action="{{ route('commande.payer', $commande) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-credit-card"></i> Payer maintenant
                    </button>
                </form>

                <a href="{{ route('commande.mes') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour aux commandes
                </a>
            </div>
        </div>
    </div>
@endsection
