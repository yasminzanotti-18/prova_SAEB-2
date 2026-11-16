@extends('layouts.app')

@section('titulo', 'Painel')

@section('conteudo')

<div class="boas-vindas">
    <div>
        <h2>Bem-vindo ao painel!</h2>
        <p>Acompanhe os indicadores e a movimentação da oficina.</p>
    </div>
</div>

<div class="cards-dashboard">

    <div class="card-dashboard">
        <div class="card-dashboard-icone">♙</div>
        <div>
            <span>Total de clientes</span>
            <h2>{{ $totalClientes }}</h2>
        </div>
    </div>

    <div class="card-dashboard">
        <div class="card-dashboard-icone">🚘</div>
        <div>
            <span>Veículos cadastrados</span>
            <h2>{{ $totalVeiculos }}</h2>
        </div>
    </div>

    <div class="card-dashboard">
        <div class="card-dashboard-icone">▣</div>
        <div>
            <span>Agendamentos de hoje</span>
            <h2>{{ $agendamentosHoje }}</h2>
        </div>
    </div>

    <div class="card-dashboard">
        <div class="card-dashboard-icone">◷</div>
        <div>
            <span>Agendamentos pendentes</span>
            <h2>{{ $agendamentosPendentes }}</h2>
        </div>
    </div>

</div>

<div class="painel-inferior">

    <div class="bloco-painel">
        <div class="bloco-painel-cabecalho">
            <div>
                <h3>Próximos agendamentos</h3>
                <p>Serviços programados para a oficina.</p>
            </div>

            <a href="{{ route('agendamentos.index') }}">
                Ver todos
            </a>
        </div>

        <div class="lista-agendamentos">

            @forelse($proximosAgendamentos as $agendamento)

                <div class="item-agendamento">
                    <div class="data-agendamento">
                        <strong>{{ $agendamento->data_agendamento->format('d') }}</strong>
                        <span>{{ $agendamento->data_agendamento->format('M') }}</span>
                    </div>

                    <div class="informacoes-agendamento">
                        <strong>{{ $agendamento->veiculo->cliente->nome }}</strong>

                        <span>
                            {{ $agendamento->veiculo->marca }}
                            {{ $agendamento->veiculo->modelo }}
                            · {{ $agendamento->servico }}
                        </span>

                        <small>
                            {{ substr($agendamento->hora_agendamento, 0, 5) }}
                        </small>
                    </div>

                    <span class="status-agendamento status-{{ strtolower($agendamento->status) }}">
                        {{ $agendamento->status }}
                    </span>
                </div>

            @empty

                <div class="sem-registros">
                    Nenhum próximo agendamento encontrado.
                </div>

            @endforelse

        </div>
    </div>

    <div class="bloco-painel bloco-acessos">
        <h3>Acesso rápido</h3>
        <p>Gerencie as principais áreas do sistema.</p>

        <a href="{{ route('clientes.index') }}" class="atalho-painel">
            <span>♙</span>
            <div>
                <strong>Clientes</strong>
                <small>Gerenciar clientes</small>
            </div>
            <span>→</span>
        </a>

        <a href="{{ route('veiculos.index') }}" class="atalho-painel">
            <span>🚘</span>
            <div>
                <strong>Veículos</strong>
                <small>Gerenciar veículos</small>
            </div>
            <span>→</span>
        </a>

        <a href="{{ route('agendamentos.index') }}" class="atalho-painel">
            <span>▣</span>
            <div>
                <strong>Agendamentos</strong>
                <small>Gerenciar serviços</small>
            </div>
            <span>→</span>
        </a>

        <a href="{{ route('agendamentos.create') }}" class="atalho-painel">
            <span>＋</span>
            <div>
                <strong>Novo agendamento</strong>
                <small>Registrar novo serviço</small>
            </div>
            <span>→</span>
        </a>

    </div>

</div>

@endsection