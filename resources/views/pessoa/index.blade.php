@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pessoas</h1>

    <!-- Exibição da mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('home') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nome ou email" value="{{ old('search', $query) }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <a href="{{ route('pessoa.create') }}" class="btn btn-success mb-3">Cadastrar Nova Pessoa</a>
    <a href="{{ route('sorteio') }}" class="btn btn-success mb-3">Realizar Sorteio</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pessoas as $pessoa)
                <tr>
                    <td>
                        <a href="{{ route('pessoa.edit', $pessoa->id) }}">{{ $pessoa->nome }}</a>
                    </td>
                    <td>{{ $pessoa->email }}</td>
                    <td>
                        <a href="{{ route('pessoa.confirmarDelecao', $pessoa->id) }}" class="btn btn-danger">Deletar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
