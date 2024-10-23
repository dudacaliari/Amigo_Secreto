@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados do Sorteio</h1>
    <ul class="list-group">
        @foreach($resultados as $resultado)
            <li class="list-group-item">{{ $resultado }}</li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Voltar para a Home</a>
</div>

    <!-- Incluindo os arquivos CSS e JS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
