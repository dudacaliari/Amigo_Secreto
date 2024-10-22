<?php

namespace App\Http\Controllers;


use App\Models\Pessoa;
use App\Models\Gift;  
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $pessoas = Pessoa::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nome', 'like', "%{$query}%")
                                ->orWhere('sobrenome', 'like', "%{$query}%") // Adicionando a busca por sobrenome
                                ->orWhere('email', 'like', "%{$query}%");
        })->get();
    
        return view('pessoa.index', compact('pessoas', 'query'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gifts = Gift::all(); // Carrega todas as sugestões de presente
        return view('pessoa.create', compact('gifts'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'sobrenome' => 'required|min:3',
            'email' => 'required|email|unique:pessoas,email',
        ]);

        // Cria a pessoa e associa os presentes selecionados
        $pessoa = Pessoa::create($request->only(['nome', 'sobrenome', 'email']));

        // Associa os presentes (se houver seleção)
        if ($request->has('gifts')) {
            $pessoa->gifts()->attach($request->input('gifts'));
        }

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
    public function update(Request $request, Pessoa $pessoa, $id)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'sobrenome' => 'required|min:3',
            'email' => 'required|email|unique:pessoas,email,' . $id, // Corrigindo a regra de unicidade
        ]);

        // Verifica se já existe uma combinação de nome e sobrenome, ignorando o registro atual
        if (Pessoa::where('nome', $pessoa->id)
                ->where('sobrenome', $pessoa->id)
                ->where('id', '!=', $pessoa->id)
                ->exists()) {
            return back()->withErrors([
                'nome_completo' => 'Este nome e sobrenome já estão cadastrados.',
            ])->withInput();
        }

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

    public function confirmarDelecao($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return view('pessoa.confirmar_delecao', compact('pessoa'));
    }


    public function addGift(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        // Cria o novo presente
        $gift = Gift::create($request->only('nome'));

        return response()->json($gift); // Retorna o presente criado em formato JSON
    }
    
}
