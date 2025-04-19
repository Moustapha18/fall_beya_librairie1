@extends('adminlte::page')

@section('title', 'Ajouter un livre')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title"><i class="fas fa-plus"></i> Ajouter un livre</h3>
        </div>
        <div class="card-body">
            @include('livres.form')
        </div>
    </div>
@endsection
