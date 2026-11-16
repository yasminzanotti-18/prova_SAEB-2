<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VeiculoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $veiculos = Veiculo::with('cliente')
            ->when($busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('marca', 'like', "%{$busca}%")
                        ->orWhere('modelo', 'like', "%{$busca}%")
                        ->orWhere('placa', 'like', "%{$busca}%")
                        ->orWhereHas('cliente', function ($cliente) use ($busca) {
                            $cliente->where('nome', 'like', "%{$busca}%");
                        });
                });
            })
            ->orderBy('modelo')
            ->paginate(10)
            ->withQueryString();

        return view('veiculos.index', compact('veiculos', 'busca'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();

        return view('veiculos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'marca' => ['required', 'string', 'max:100'],
            'modelo' => ['required', 'string', 'max:100'],
            'ano' => ['required', 'integer', 'min:1900', 'max:2100'],
            'placa' => ['required', 'string', 'max:10', 'unique:veiculos,placa'],
            'cor' => ['nullable', 'string', 'max:50'],
        ]);

        $dados['placa'] = strtoupper($dados['placa']);

        Veiculo::create($dados);

        return redirect()
            ->route('veiculos.index')
            ->with('sucesso', 'Veículo cadastrado com sucesso!');
    }

    public function edit(Veiculo $veiculo)
    {
        $clientes = Cliente::orderBy('nome')->get();

        return view('veiculos.edit', compact('veiculo', 'clientes'));
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $dados = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'marca' => ['required', 'string', 'max:100'],
            'modelo' => ['required', 'string', 'max:100'],
            'ano' => ['required', 'integer', 'min:1900', 'max:2100'],
            'placa' => [
                'required',
                'string',
                'max:10',
                Rule::unique('veiculos', 'placa')->ignore($veiculo->id),
            ],
            'cor' => ['nullable', 'string', 'max:50'],
        ]);

        $dados['placa'] = strtoupper($dados['placa']);

        $veiculo->update($dados);

        return redirect()
            ->route('veiculos.index')
            ->with('sucesso', 'Veículo atualizado com sucesso!');
    }
}