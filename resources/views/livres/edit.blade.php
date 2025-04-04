@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Modifier le livre</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('livres.update', $livre->id) }}">
            @csrf
            @method('PUT')

            @include('livres.form')

            <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
            <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
