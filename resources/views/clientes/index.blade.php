@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')

<div class="boas-vindas">
    <div>
        <h2>Gerenciamento de clientes</h2>
        <p>Consulte, pesquise e gerencie os clientes cadastrados.</p>
    </div>

    <a href="{{ route('clientes.create') }}" class="botao-principal">
        + Novo cliente
    </a>
</div>

@if(session('sucesso'))
    <div class="mensagem-sucesso">
        {{ session('sucesso') }}
    </div>
@endif

<div class="painel-card">

    <form action="{{ route('clientes.index') }}" method="GET" class="formulario-busca">
        <input
            type="text"
            name="busca"
            placeholder="Pesquisar por nome, e-mail ou telefone..."
            value="{{ $busca }}"
        >

        <button type="submit" class="botao-principal">
            Pesquisar
        </button>

        <a href="{{ route('clientes.index') }}" class="botao-secundario">
            Limpar
        </a>
    </form>

    <div class="painel-card-topo">
        <div>
            <h3>Clientes cadastrados</h3>
            <p>{{ $clientes->total() }} cliente(s) encontrado(s).</p>
        </div>
    </div>

    <div class="tabela-responsiva">
        <table class="tabela-clientes">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->telefone ?: 'Não informado' }}</td>
                        <td>{{ $cliente->email ?: 'Não informado' }}</td>
                        <td>{{ $cliente->endereco ?: 'Não informado' }}</td>
                        <td>
                            <a
                                href="{{ route('clientes.edit', $cliente) }}"
                                class="botao-editar"
                            >
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="sem-registros">
                            Nenhum cliente encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="paginacao">
        {{ $clientes->links() }}
    </div>

</div>

@endsection