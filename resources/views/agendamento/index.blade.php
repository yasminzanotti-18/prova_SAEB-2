@extends('layouts.app')

@section('titulo', 'Agendamentos')

@section('conteudo')

<div class="cabecalho-pagina">
    <div>
        <h2>Agendamentos</h2>
        <p>Consulte e gerencie os serviços agendados na oficina.</p>
    </div>

    <a href="{{ route('agendamentos.create') }}" class="botao-principal">
        + Novo agendamento
    </a>
</div>

@if(session('sucesso'))
    <div class="mensagem-sucesso">
        {{ session('sucesso') }}
    </div>
@endif

<form action="{{ route('agendamentos.index') }}" method="GET" class="formulario-busca">
    <input
        type="text"
        name="busca"
        placeholder="Buscar por cliente, veículo, placa ou serviço..."
        value="{{ $busca }}"
    >

    <button type="submit" class="botao-principal">
        Buscar
    </button>

    @if($busca)
        <a href="{{ route('agendamentos.index') }}" class="botao-secundario">
            Limpar
        </a>
    @endif
</form>

<div class="tabela-clientes">
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Placa</th>
                <th>Serviço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->data_agendamento->format('d/m/Y') }}</td>

                    <td>{{ substr($agendamento->hora_agendamento, 0, 5) }}</td>

                    <td>{{ $agendamento->veiculo->cliente->nome }}</td>

                    <td>
                        {{ $agendamento->veiculo->marca }}
                        {{ $agendamento->veiculo->modelo }}
                    </td>

                    <td>{{ $agendamento->veiculo->placa }}</td>

                    <td>{{ $agendamento->servico }}</td>

                    <td>
                        <span class="status-agendamento status-{{ strtolower($agendamento->status) }}">
                            {{ $agendamento->status }}
                        </span>
                    </td>

                    <td>
                        <a
                            href="{{ route('agendamentos.edit', $agendamento->id) }}"
                            class="botao-editar"
                        >
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="sem-registros">
                        Nenhum agendamento encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="paginacao">
    {{ $agendamentos->links() }}
</div>

@endsection