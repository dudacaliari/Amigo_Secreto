@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="titulo">Amigo Secreto! 🙊</h1>

    <!-- Exibição da mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('home') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Busque por um nome, sobrenome ou email" value="{{ old('search', $query) }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <a href="{{ route('pessoa.create') }}" class="btn btn-success mb-3">Adicionar Participante</a>
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
                        <a class="pessoa_link" href="{{ route('pessoa.edit', $pessoa->id) }}">
                            {{ $pessoa->nome }} {{ $pessoa->sobrenome }}
                        </a>
                        <div>
                            @foreach($pessoa->gifts as $gift)
                                <span class="badge gift-{{ $loop->index + 1 }}">{{ $gift->nome }}</span>
                            @endforeach
                        </div>
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

<!-- Incluindo os arquivos CSS e JS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
