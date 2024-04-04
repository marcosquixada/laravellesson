<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        // Criação do Cargo
        $cargo = new Cargo();
        $cargo->descricao = $request->descricao;
        $cargo->save();

        // Redirecionar para uma página com uma mensagem de sucesso
        return redirect()->route('cargos.index')->with('success', 'Cargo adicionado com sucesso!');
    }

    // public function index()
    // {
    //     $cargos = Cargo::all();
    //     return view('app', compact('cargos')); // Aqui, 'app' é o nome do seu arquivo Blade.
    // }

    public function index(Request $request)
    {
        $query = Cargo::query();

        // Filtros
        if ($request->filled('codigo')) {
            $query->where('codigo', $request->codigo);
        }
        if ($request->filled('descricao')) {
            $query->where('descricao', 'like', '%' . $request->descricao . '%');
        }

        // Paginação com filtros aplicados
        $cargos = $query->paginate(10);

        return view('app', compact('cargos'));
    }
}
