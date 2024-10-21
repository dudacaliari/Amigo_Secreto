@extends('layouts.app')

@section('content')
    <h1>Cadastrar Pessoa</h1>
    <form action="{{ route('pessoa.store') }}" method="POST">
        @csrf
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Salvar</button>
    </form>
@endsection
