@extends('layouts.app')

@section('titulo', 'Veículos')

@section('conteudo')

<div class="cabecalho-pagina">
    <div>
        <h2>Veículos cadastrados</h2>
        <p>Consulte e gerencie os veículos dos clientes.</p>
    </div>

    <a href="{{ route('veiculos.create') }}" class="botao-principal">
        + Novo veículo
    </a>
</div>

@if(session('sucesso'))
    <div class="mensagem-sucesso">
        {{ session('sucesso') }}
    </div>
@endif

<form action="{{ route('veiculos.index') }}" method="GET" class="formulario-busca">
    <input
        type="text"
        name="busca"
        placeholder="Buscar por marca, modelo, placa ou cliente..."
        value="{{ $busca }}"
    >

    <button type="submit" class="botao-principal">
        Buscar
    </button>

    @if($busca)
        <a href="{{ route('veiculos.index') }}" class="botao-secundario">
            Limpar
        </a>
    @endif
</form>

<div class="tabela-clientes">
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Cor</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($veiculos as $veiculo)
                <tr>
                    <td>{{ $veiculo->cliente->nome }}</td>
                    <td>{{ $veiculo->marca }}</td>
                    <td>{{ $veiculo->modelo }}</td>
                    <td>{{ $veiculo->ano }}</td>
                    <td>{{ $veiculo->placa }}</td>
                    <td>{{ $veiculo->cor ?? 'Não informada' }}</td>
                    <td>
                        <a
                            href="{{ route('veiculos.edit', $veiculo->id) }}"
                            class="botao-editar"
                        >
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="sem-registros">
                        Nenhum veículo encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="paginacao">
    {{ $veiculos->links() }}
</div>

@endsection