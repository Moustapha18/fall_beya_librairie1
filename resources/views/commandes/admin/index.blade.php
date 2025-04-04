
@extends('adminlte::page')

@section('title', 'Commandes clients')

@section('content_header')
    <a href="{{ route('commandes.export.pdf') }}" class="btn btn-outline-dark mb-3">📥 Exporter PDF</a>

    <h1>Liste des commandes</h1>
@endsection

@section('content')
    <form method="GET" action="{{ route('commandes.index') }}" class="mb-4 row g-3 align-items-end">
        <div class="col-md-4">
            <label for="client" class="form-label">Client</label>
            <input type="text" name="client" id="client" value="{{ request('client') }}" class="form-control" placeholder="Nom du client">
        </div>

        <div class="col-md-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-select">
                <option value="">-- Tous --</option>
                <option value="en attente" {{ request('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="payée" {{ request('statut') == 'payée' ? 'selected' : '' }}>Payée</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control">
        </div>

        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-success">🔍 Rechercher</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Client</th><th>Date</th><th>Total</th><th>Statut</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->user->name }}</td>
                <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                <td>{{ $commande->total }} €</td>
                <td>{{ ucfirst($commande->statut) }}</td>
                <td>
                    @if($commande->statut !== 'payée')
                        <form action="{{ route('commandes.payer', $commande->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">💰 Payer</button>
                        </form>
                    @endif

                    <a href="{{ route('commandes.show', $commande) }}" class="btn btn-sm btn-primary">Voir</a>
                    <form method="POST" action="{{ route('commandes.destroy', $commande) }}" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Annuler la commande ?')">Annuler</button>
                    </form>
                </td>
                <td>
    <span class="badge bg-{{ $commande->statut === 'payée' ? 'success' : 'warning' }}">
        {{ ucfirst($commande->statut) }}
    </span>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        <a href="{{ route('commandes.index') }}" class="btn btn-secondary btn-sm">📋 Toutes</a>
        <a href="{{ route('commandes.enAttente') }}" class="btn btn-warning btn-sm">🕒 En attente</a>
        <a href="{{ route('commandes.payees') }}" class="btn btn-success btn-sm">✅ Payées</a>
    </div>

@endsection
