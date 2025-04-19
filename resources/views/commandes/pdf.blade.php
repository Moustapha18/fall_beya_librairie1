<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la commande #{{ $commande->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
<h2>Commande #{{ $commande->id }}</h2>
<p><strong>Client :</strong> {{ $commande->user->name ?? 'Inconnu' }}</p>
<p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y') }}</p>
<p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>

<table>
    <thead>
    <tr>
        <th>Livre</th>
        <th>Quantité</th>
        <th>Prix unitaire (€)</th>
        <th>Total (€)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commande->livres as $livre)
        <tr>
            <td>{{ $livre->titre }}</td>
            <td>{{ $livre->pivot->quantite }}</td>
            <td>{{ number_format($livre->pivot->prix_unitaire, 2, ',', ' ') }}</td>
            <td>{{ number_format($livre->pivot->prix_unitaire * $livre->pivot->quantite, 2, ',', ' ') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p><strong>Total à payer :</strong> {{ number_format($commande->total, 2, ',', ' ') }} F CFA</p>
</body>
</html>
