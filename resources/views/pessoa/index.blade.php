@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pessoas</h1>

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
                    <td>{{ $pessoa->nome }}</td>
                    <td>{{ $pessoa->email }}</td>
                    <td>
                        <a href="{{ route('pessoa.edit', $pessoa->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('pessoa.destroy', $pessoa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection