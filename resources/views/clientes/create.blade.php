@extends('layouts.app')

@section('titulo', 'Novo cliente')

@section('conteudo')

<div class="boas-vindas">
    <div>
        <h2>Cadastrar cliente</h2>
        <p>Preencha os dados para registrar um novo cliente.</p>
    </div>

    <a href="{{ route('clientes.index') }}" class="botao-secundario">
        Voltar
    </a>
</div>

<div class="painel-card">

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="campo-formulario">
                <label for="nome">Nome completo *</label>
                <input type="text" id="nome" name="nome"
                    value="{{ old('nome') }}" required>
                @error('nome')
                    <small class="erro-campo">{{ $message }}</small>
                @enderror
            </div>

            <div class="campo-formulario">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf"
                    value="{{ old('cpf') }}" maxlength="14"
                    placeholder="000.000.000-00">
                @error('cpf')
                    <small class="erro-campo">{{ $message }}</small>
                @enderror
            </div>

            <div class="campo-formulario">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone"
                    value="{{ old('telefone') }}"
                    placeholder="(00) 00000-0000">
                @error('telefone')
                    <small class="erro-campo">{{ $message }}</small>
                @enderror
            </div>

            <div class="campo-formulario">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="erro-campo">{{ $message }}</small>
                @enderror
            </div>

            <div class="campo-formulario campo-completo">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco"
                    value="{{ old('endereco') }}"
                    placeholder="Rua, número, bairro e cidade">
                @error('endereco')
                    <small class="erro-campo">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="acoes-formulario">
            <a href="{{ route('clientes.index') }}" class="botao-secundario">
                Cancelar
            </a>

            <button type="submit" class="botao-principal">
                Salvar cliente
            </button>
        </div>

    </form>

</div>

@endsection