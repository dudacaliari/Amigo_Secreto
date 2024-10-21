@extends('layouts.app')

@section('content')
    <h1>Lista de Pessoas</h1>
    <a href="{{ route('pessoa.create') }}">Cadastrar Pessoa</a>
    <ul>
        @foreach($pessoas as $pessoa)
            <li>
                {{ $pessoa->nome }} - {{ $pessoa->email }}
                <a href="{{ route('pessoa.edit', $pessoa->id) }}">Editar</a>
                <form action="{{ route('pessoa.destroy', $pessoa->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar</button>
                </form>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('sorteio') }}">Realizar Sorteio</a>
@endsection
