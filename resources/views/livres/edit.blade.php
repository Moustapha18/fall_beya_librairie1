@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">✏️ Modifier le livre</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('livres.update', $livre->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('livres.form')

                    <button type="submit" class="btn btn-primary">
                        💾 Mettre à jour
                    </button>
                    <a href="{{ route('livres.index') }}" class="btn btn-secondary">
                        🔙 Annuler
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
