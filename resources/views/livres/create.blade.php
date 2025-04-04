@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ajouter un livre</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('livres.store') }}">
            @include('livres.form')

            <button type="submit" class="btn btn-success">💾 Enregistrer</button>
            <a href="{{ route('livres.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
@endsection
