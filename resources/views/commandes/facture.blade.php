<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .titre { font-size: 20px; font-weight: bold; margin-bottom: 20px; }
        .ligne { margin: 5px 0; }
    </style>
</head>
<body>
<div class="titre">Facture - Commande #{{ $commande->id }}</div>

<div class="ligne"><strong>Client :</strong> {{ $commande->user->name }}</div>
<div class="ligne"><strong>Email :</strong> {{ $commande->user->email }}</div>
<div class="ligne"><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y') }}</div>
<hr>

@foreach ($commande->livres as $livre)
    <div class="ligne">
        {{ $livre->titre }} — {{ $livre->pivot->quantite }} × {{ number_format($livre->pivot->prix_unitaire, 2, ',', ' ') }} F CFA
    </div>
@endforeach

<hr>
<div class="ligne"><strong>Total :</strong> {{ number_format($commande->total, 2, ',', ' ') }} F CFA</div>
</body>
</html>
