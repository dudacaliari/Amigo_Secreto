<?php

namespace App\Http\Controllers;


use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoas = Pessoa::all();
        return view('pessoa.index', compact('pessoas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pessoa.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:pessoas,email',
        ]);

        Pessoa::create($request->all());
        return redirect()->route('home')->with('success', 'Pessoa cadastrada com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return view('pessoa.edit', compact('pessoa'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:pessoas,email,' . $id,
        ]);
    
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());
    
        return redirect()->route('home')->with('success', 'Pessoa atualizada com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();
    
        return redirect()->route('home')->with('success', 'Pessoa deletada com sucesso!');
    }

    public function sorteio()
    {
        $pessoas = Pessoa::all()->shuffle();
        $resultados = [];

        for ($i = 0; $i < count($pessoas); $i++) {
            $amigo = $pessoas[($i + 1) % count($pessoas)];
            $resultados[] = "{$pessoas[$i]->nome} tirou {$amigo->nome}";
        }

        return view('pessoa.sorteio', compact('resultados'));
    }

    
}
