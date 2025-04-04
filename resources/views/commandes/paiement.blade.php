@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Paiement de la commande n°{{ $commande->id }}</h2>
        <p>Montant à régler : <strong>{{ number_format($commande->total, 2, ',', ' ') }} €</strong></p>

        <form action="{{ route('commande.payer', $commande) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Payer maintenant</button>
        </form>
    </div>
@endsection
