@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Confirmação de Deleção</h1>
    <p>Tem certeza que deseja deletar {{ $pessoa->nome }}?</p>
    <form action="{{ route('pessoa.destroy', $pessoa->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Deletar</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
