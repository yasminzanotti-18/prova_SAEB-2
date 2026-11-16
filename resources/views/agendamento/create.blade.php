@extends('layouts.app')

@section('titulo', 'Novo agendamento')

@section('conteudo')

<div class="cabecalho-pagina">
    <div>
        <h2>Novo agendamento</h2>
        <p>Registre um serviço que será realizado na oficina.</p>
    </div>

    <a href="{{ route('agendamentos.index') }}" class="botao-secundario">
        Voltar
    </a>
</div>

<form action="{{ route('agendamentos.store') }}" method="POST" class="formulario">
    @csrf

    <div class="form-grid">

        <div class="campo-formulario campo-completo">
            <label for="veiculo_id">Cliente e veículo</label>

            <select name="veiculo_id" id="veiculo_id" required>
                <option value="">Selecione o cliente e o veículo</option>

                @foreach($veiculos as $veiculo)
                    <option
                        value="{{ $veiculo->id }}"
                        {{ old('veiculo_id') == $veiculo->id ? 'selected' : '' }}
                    >
                        {{ $veiculo->cliente->nome }} -
                        {{ $veiculo->marca }} {{ $veiculo->modelo }} -
                        {{ $veiculo->placa }}
                    </option>
                @endforeach
            </select>

            @error('veiculo_id')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario">
            <label for="data_agendamento">Data</label>

            <input
                type="date"
                name="data_agendamento"
                id="data_agendamento"
                value="{{ old('data_agendamento') }}"
                required
            >

            @error('data_agendamento')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario">
            <label for="hora_agendamento">Horário</label>

            <input
                type="time"
                name="hora_agendamento"
                id="hora_agendamento"
                value="{{ old('hora_agendamento') }}"
                required
            >

            @error('hora_agendamento')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario campo-completo">
            <label for="servico">Serviço solicitado</label>

            <input
                type="text"
                name="servico"
                id="servico"
                value="{{ old('servico') }}"
                placeholder="Ex.: Troca de óleo, revisão, alinhamento..."
                required
            >

            @error('servico')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario campo-completo">
            <label for="status">Status</label>

            <select name="status" id="status" required>
                <option value="Pendente" {{ old('status', 'Pendente') == 'Pendente' ? 'selected' : '' }}>
                    Pendente
                </option>

                <option value="Confirmado" {{ old('status') == 'Confirmado' ? 'selected' : '' }}>
                    Confirmado
                </option>

                <option value="Concluido" {{ old('status') == 'Concluido' ? 'selected' : '' }}>
                    Concluído
                </option>

                <option value="Cancelado" {{ old('status') == 'Cancelado' ? 'selected' : '' }}>
                    Cancelado
                </option>
            </select>

            @error('status')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario campo-completo">
            <label for="observacoes">Observações</label>

            <textarea
                name="observacoes"
                id="observacoes"
                rows="4"
                placeholder="Informações adicionais sobre o serviço..."
            >{{ old('observacoes') }}</textarea>

            @error('observacoes')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="acoes-formulario">
        <a href="{{ route('agendamentos.index') }}" class="botao-secundario">
            Cancelar
        </a>

        <button type="submit" class="botao-principal">
            Salvar agendamento
        </button>
    </div>

</form>

@endsection