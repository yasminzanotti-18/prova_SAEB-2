<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('titulo') | Oficina</title>

    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">

    
</head>
<body>

    <div class="estrutura">

        <aside class="menu-lateral">

            <div class="logo">
                <div class="logo-icone">O</div>
                <div>
                    <h2>OFICINA</h2>
                    <span>GESTÃO AUTOMOTIVA</span>
                </div>
            </div>

            <div class="menu-titulo">MENU PRINCIPAL</div>

            <nav>
                <a href="{{ route('painel') }}"
                   class="menu-link {{ request()->routeIs('painel') ? 'ativo' : '' }}">
                    <span>▦</span> Painel
                </a>

                <a href="{{ route('clientes.index') }}"
                   class="menu-link {{ request()->routeIs('clientes.*') ? 'ativo' : '' }}">
                    <span>♙</span> Clientes
                </a>

                <a href="{{ route('veiculos.index') }}"
                   class="menu-link {{ request()->routeIs('veiculos.*') ? 'ativo' : '' }}">
                    <span>🚘</span> Veículos
                </a>

                <a href="{{ route('agendamentos.index') }}"
                   class="menu-link {{ request()->routeIs('agendamentos.*') ? 'ativo' : '' }}">
                    <span>▣</span> Agendamentos
                </a>
            </nav>

            <div class="menu-rodape">
                <div class="menu-titulo">SISTEMA</div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="sair">
                        <span>⇥</span> Sair do sistema
                    </button>
                </form>
            </div>

        </aside>

        <main class="conteudo">

            <header class="topo">

                <div>
                    <span class="subtitulo-topo">GESTÃO DA OFICINA</span>
                    <h1>@yield('titulo')</h1>
                </div>

                <div class="usuario">

                    <div class="avatar">
                    {{ strtoupper(substr(session('usuario_nome'), 0, 1)) }}
                </div>

                <div>
                    <strong>{{ session('usuario_nome') }}</strong>
                    <span>Administrador</span>
                </div>

                </div>

            </header>

            <section class="conteudo-principal">
                @yield('conteudo')
            </section>

            <footer>
                Sistema de Gestão de Oficina · Desenvolvido para SAEP
            </footer>

        </main>

    </div>

</body>
</html>