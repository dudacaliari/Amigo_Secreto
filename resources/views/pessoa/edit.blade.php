@extends('layouts.app')

@section('content')
    <h1>Editar Pessoa</h1>

    <form action="{{ route('pessoa.update', $pessoa->id) }}" method="POST" oninput="validateForm()">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $pessoa->nome }}" required minlength="3">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $pessoa->email }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" id="saveButton" disabled>Salvar Alterações</button>
    </form>

    <script>
        function validateForm() {
            const form = document.querySelector('form');
            const button = document.getElementById('saveButton');
            button.disabled = !form.checkValidity();
        }
    </script>
@endsection
