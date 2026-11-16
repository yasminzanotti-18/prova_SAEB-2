<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $agendamentos = Agendamento::with('veiculo.cliente')
            ->when($busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('servico', 'like', "%{$busca}%")
                        ->orWhere('status', 'like', "%{$busca}%")
                        ->orWhereHas('veiculo', function ($veiculo) use ($busca) {
                            $veiculo->where('modelo', 'like', "%{$busca}%")
                                ->orWhere('placa', 'like', "%{$busca}%")
                                ->orWhereHas('cliente', function ($cliente) use ($busca) {
                                    $cliente->where('nome', 'like', "%{$busca}%");
                                });
                        });
                });
            })
            ->orderBy('data_agendamento')
            ->orderBy('hora_agendamento')
            ->paginate(10)
            ->withQueryString();

        return view('agendamentos.index', compact('agendamentos', 'busca'));
    }

    public function create()
    {
        $veiculos = Veiculo::with('cliente')
            ->orderBy('modelo')
            ->get();

        return view('agendamentos.create', compact('veiculos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'veiculo_id' => ['required', 'exists:veiculos,id'],
            'data_agendamento' => ['required', 'date'],
            'hora_agendamento' => ['required', 'date_format:H:i'],
            'servico' => ['required', 'string', 'max:150'],
            'status' => ['required', 'in:Pendente,Confirmado,Concluido,Cancelado'],
            'observacoes' => ['nullable', 'string'],
        ]);

        Agendamento::create($dados);

        return redirect()
            ->route('agendamentos.index')
            ->with('sucesso', 'Agendamento cadastrado com sucesso!');
    }

    public function edit(Agendamento $agendamento)
    {
        $veiculos = Veiculo::with('cliente')
            ->orderBy('modelo')
            ->get();

        return view('agendamentos.edit', compact('agendamento', 'veiculos'));
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $dados = $request->validate([
            'veiculo_id' => ['required', 'exists:veiculos,id'],
            'data_agendamento' => ['required', 'date'],
            'hora_agendamento' => ['required', 'date_format:H:i'],
            'servico' => ['required', 'string', 'max:150'],
            'status' => ['required', 'in:Pendente,Confirmado,Concluido,Cancelado'],
            'observacoes' => ['nullable', 'string'],
        ]);

        $agendamento->update($dados);

        return redirect()
            ->route('agendamentos.index')
            ->with('sucesso', 'Agendamento atualizado com sucesso!');
    }
}