<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
<h2>Liste des commandes</h2>

<table>
    <thead>
    <tr>
        <th>Client</th>
        <th>Date</th>
        <th>Total (F CFA)</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commandes as $commande)
        <tr>
            <td>{{ $commande->user->name }}</td>
            <td>{{ $commande->created_at->format('d/m/Y') }}</td>
            <td>{{ $commande->total }}</td>
            <td>{{ ucfirst($commande->statut) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

