@extends('layouts.app')

@section('titulo', 'Novo veículo')

@section('conteudo')

<div class="cabecalho-pagina">
    <div>
        <h2>Cadastrar veículo</h2>
        <p>Preencha os dados do veículo e vincule-o a um cliente.</p>
    </div>

    <a href="{{ route('veiculos.index') }}" class="botao-secundario">
        Voltar
    </a>
</div>

<form action="{{ route('veiculos.store') }}" method="POST" class="formulario">
    @csrf

    <div class="form-grid">

        <div class="campo-formulario campo-completo">
            <label for="cliente_id">Cliente</label>

            <select name="cliente_id" id="cliente_id" required>
                <option value="">Selecione um cliente</option>

                @foreach($clientes as $cliente)
                    <option
                        value="{{ $cliente->id }}"
                        {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}
                    >
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>

            @error('cliente_id')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario">
            <label for="marca">Marca</label>
            <input
                type="text"
                name="marca"
                id="marca"
                value="{{ old('marca') }}"
                placeholder="Ex.: Volkswagen"
                required
            >
            @error('marca')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario">
            <label for="modelo">Modelo</label>
            <input
                type="text"
                name="modelo"
                id="modelo"
                value="{{ old('modelo') }}"
                placeholder="Ex.: Gol"
                required
            >
            @error('modelo')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario">
            <label for="ano">Ano</label>
            <input
                type="number"
                name="ano"
                id="ano"
                value="{{ old('ano') }}"
                min="1900"
                max="2100"
                placeholder="Ex.: 2022"
                required
            >
            @error('ano')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario">
            <label for="placa">Placa</label>
            <input
                type="text"
                name="placa"
                id="placa"
                value="{{ old('placa') }}"
                maxlength="10"
                placeholder="Ex.: ABC1D23"
                required
            >
            @error('placa')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario campo-completo">
            <label for="cor">Cor</label>
            <input
                type="text"
                name="cor"
                id="cor"
                value="{{ old('cor') }}"
                placeholder="Ex.: Preto"
            >
            @error('cor')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="acoes-formulario">
        <a href="{{ route('veiculos.index') }}" class="botao-secundario">
            Cancelar
        </a>

        <button type="submit" class="botao-principal">
            Salvar veículo
        </button>
    </div>

</form>

@endsection