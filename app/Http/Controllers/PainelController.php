<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Agendamento;

class PainelController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();

        $totalVeiculos = Veiculo::count();

        $agendamentosHoje = Agendamento::whereDate(
            'data_agendamento',
            today()
        )->count();

        $agendamentosPendentes = Agendamento::where(
            'status',
            'Pendente'
        )->count();

        $proximosAgendamentos = Agendamento::with('veiculo.cliente')
            ->whereDate('data_agendamento', '>=', today())
            ->whereIn('status', ['Pendente', 'Confirmado'])
            ->orderBy('data_agendamento')
            ->orderBy('hora_agendamento')
            ->take(5)
            ->get();

        return view('painel', compact(
            'totalClientes',
            'totalVeiculos',
            'agendamentosHoje',
            'agendamentosPendentes',
            'proximosAgendamentos'
        ));
    }
}