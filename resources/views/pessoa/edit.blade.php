@extends('layouts.app')

@section('content')
    <h1 class="titulo">Editar Participante</h1>

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

    <form action="{{ route('pessoa.update', $pessoa->id) }}" method="POST" oninput="validateForm()">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{ old('nome', $pessoa->nome) }}" required minlength="3">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sobrenome" class="form-label">Sobrenome</label>
            <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{{ old('sobrenome', $pessoa->sobrenome) }}" required minlength="3">
            @error('sobrenome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $pessoa->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sugestões de Presente</label>
            <div id="giftSuggestions">
                @foreach($gifts as $gift)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="gifts[]" value="{{ $gift->id }}" id="gift{{ $gift->id }}"
                        @if($pessoa->gifts->contains($gift->id)) checked @endif>
                        <label class="form-check-label" for="gift{{ $gift->id }}">{{ $gift->nome }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="saveButton">Salvar</button>
    </form>

    <!-- Incluindo os arquivos CSS e JS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
