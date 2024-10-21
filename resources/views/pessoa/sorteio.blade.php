@extends('layouts.app')

@section('content')
    <h1>Resultado do Sorteio</h1>
    <ul>
        @foreach($resultados as $resultado)
            <li>{{ $resultado }}</li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}">Voltar</a>
@endsection
