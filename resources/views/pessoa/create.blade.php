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

        <div class="mb-3">
            <label class="form-label">Sugestões de Presente</label>
            <div id="giftSuggestions">
                <!-- Sugestões de presente pré-definidas -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gifts[]" value="1" id="gift1">
                    <label class="form-check-label" for="gift1">Livro</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gifts[]" value="2" id="gift2">
                    <label class="form-check-label" for="gift2">Roupas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gifts[]" value="3" id="gift3">
                    <label class="form-check-label" for="gift3">Eletrônicos</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gifts[]" value="4" id="gift4">
                    <label class="form-check-label" for="gift4">Experiência (viagem, jantar, etc.)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gifts[]" value="5" id="gift5">
                    <label class="form-check-label" for="gift5">Flores</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="saveButton">Salvar</button>
    </form>

    <script>
        function validateForm() {
            const nome = document.getElementById('nome').value;
            const sobrenome = document.getElementById('sobrenome').value;
            const email = document.getElementById('email').value;
            const saveButton = document.getElementById('saveButton');

            // Habilitar botão somente se todos os campos obrigatórios estiverem preenchidos
            if (nome.length >= 3 && sobrenome.length >= 3 && email) {
                saveButton.disabled = false;
            } else {
                saveButton.disabled = true;
            }
        }

        // Inicializa o estado do botão salvar
        document.addEventListener("DOMContentLoaded", function() {
            validateForm();
        });
    </script>
@endsection
