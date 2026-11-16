@extends('layouts.app')

@section('titulo', 'Editar agendamento')

@section('conteudo')

<div class="cabecalho-pagina">
    <div>
        <h2>Editar agendamento</h2>
        <p>Atualize as informações do serviço agendado.</p>
    </div>

    <a href="{{ route('agendamentos.index') }}" class="botao-secundario">
        Voltar
    </a>
</div>

<form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" class="formulario">
    @csrf
    @method('PUT')

    <div class="form-grid">

        <div class="campo-formulario campo-completo">
            <label for="veiculo_id">Cliente e veículo</label>

            <select name="veiculo_id" id="veiculo_id" required>
                <option value="">Selecione o cliente e o veículo</option>

                @foreach($veiculos as $veiculo)
                    <option
                        value="{{ $veiculo->id }}"
                        {{ old('veiculo_id', $agendamento->veiculo_id) == $veiculo->id ? 'selected' : '' }}
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
                value="{{ old('data_agendamento', $agendamento->data_agendamento->format('Y-m-d')) }}"
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
                value="{{ old('hora_agendamento', substr($agendamento->hora_agendamento, 0, 5)) }}"
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
                value="{{ old('servico', $agendamento->servico) }}"
                required
            >

            @error('servico')
                <span class="erro-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo-formulario campo-completo">
            <label for="status">Status</label>

            <select name="status" id="status" required>
                <option value="Pendente" {{ old('status', $agendamento->status) == 'Pendente' ? 'selected' : '' }}>
                    Pendente
                </option>

                <option value="Confirmado" {{ old('status', $agendamento->status) == 'Confirmado' ? 'selected' : '' }}>
                    Confirmado
                </option>

                <option value="Concluido" {{ old('status', $agendamento->status) == 'Concluido' ? 'selected' : '' }}>
                    Concluído
                </option>

                <option value="Cancelado" {{ old('status', $agendamento->status) == 'Cancelado' ? 'selected' : '' }}>
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
                placeholder="Informações adicionais..."
            >{{ old('observacoes', $agendamento->observacoes) }}</textarea>

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
            Atualizar agendamento
        </button>
    </div>

</form>

@endsection