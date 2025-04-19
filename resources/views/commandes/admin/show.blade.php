@extends('adminlte::page')

@section('title', 'Commande #'.$commande->id)

@section('content_header')
    <h1>Détails de la commande</h1>
@endsection


@section('content')
    <a href="{{ route('commandes.pdf', $commande) }}" class="btn btn-outline-secondary mb-3">
        📄 Télécharger PDF
    </a>
    <p><strong>Client :</strong> {{ $commande->user->name }}</p>
    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Statut actuel :</strong> {{ ucfirst($commande->statut) }}</p>

    <form method="POST" action="{{ route('commandes.statut', $commande) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Changer le statut</label>
            <select name="statut" class="form-control">
                <option value="en attente" @selected($commande->statut == 'en attente')>En attente</option>
                <option value="en préparation" @selected($commande->statut == 'en préparation')>En préparation</option>
                <option value="expédiée" @selected($commande->statut == 'expédiée')>Expédiée</option>
                <option value="payée" @selected($commande->statut == 'payée')>Payée</option>
            </select>
        </div>
        <button class="btn btn-success mt-2" type="submit">Mettre à jour</button>
    </form>

    <hr>

    <h4>Livres commandés</h4>
    <ul>
        @foreach($commande->livres as $livre)
            <li>{{ $livre->titre }} — {{ $livre->pivot->quantite }} x {{ $livre->pivot->prix_unitaire }} F CFA</li>
        @endforeach
    </ul>
    <p><strong>Total :</strong> {{ $commande->total }} F CFA</p>
@endsection

