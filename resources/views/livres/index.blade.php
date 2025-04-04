@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        <h1 class="mb-4 text-center fw-bold text-primary">📚 Liste des livres</h1>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('livres.create') }}" class="btn btn-success">
                ➕ Ajouter un livre
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th class="text-uppercase">Titre</th>
                    <th class="text-uppercase">Auteur</th>
                    <th class="text-uppercase">Catégorie</th>
                    <th class="text-uppercase">Prix</th>
                    <th class="text-uppercase">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($livres as $livre)
                    <tr>
                        <td>{{ $livre->titre }}</td>
                        <td>{{ $livre->auteur }}</td>
                        <td>{{ $livre->categorie }}</td>
                        <td>{{ number_format($livre->prix, 2) }} €</td>
                        <td>
                            <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-warning btn-sm me-1">
                                ✏️ Modifier
                            </a>

                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Aucun livre trouvé.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
