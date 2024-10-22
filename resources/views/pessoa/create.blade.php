@extends('layouts.app')

@section('content')
    <h1>Cadastrar Pessoa</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pessoa.store') }}" method="POST" oninput="validateForm()">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{ old('nome') }}" required minlength="3">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sobrenome" class="form-label">Sobrenome</label>
            <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{{ old('sobrenome') }}" required minlength="3">
            @error('sobrenome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" id="saveButton" disabled>Salvar</button>
    </form>

    <script>
        function validateForm() {
            const form = document.querySelector('form');
            const button = document.getElementById('saveButton');
            button.disabled = !form.checkValidity();
        }
    </script>
@endsection
