@extends('layouts.app')

@section('titulo', 'Editar veículo')

@section('conteudo')

<div class="cabecalho-pagina">
    <div>
        <h2>Editar veículo</h2>
        <p>Atualize as informações do veículo cadastrado.</p>
    </div>

    <a href="{{ route('veiculos.index') }}" class="botao-secundario">
        Voltar
    </a>
</div>

<form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST" class="formulario">
    @csrf
    @method('PUT')

    <div class="form-grid">

        <div class="campo-formulario campo-completo">
            <label for="cliente_id">Cliente</label>

            <select name="cliente_id" id="cliente_id" required>
                <option value="">Selecione um cliente</option>

                @foreach($clientes as $cliente)
                    <option
                        value="{{ $cliente->id }}"
                        {{ old('cliente_id', $veiculo->cliente_id) == $cliente->id ? 'selected' : '' }}
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
                value="{{ old('marca', $veiculo->marca) }}"
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
                value="{{ old('modelo', $veiculo->modelo) }}"
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
                value="{{ old('ano', $veiculo->ano) }}"
                min="1900"
                max="2100"
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
                value="{{ old('placa', $veiculo->placa) }}"
                maxlength="10"
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
                value="{{ old('cor', $veiculo->cor) }}"
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
            Atualizar veículo
        </button>
    </div>

</form>

@endsection