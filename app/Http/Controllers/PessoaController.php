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
    
        // Verifica se já existe uma combinação de nome e sobrenome
        if (Pessoa::where('nome', $request->nome)
                ->where('sobrenome', $request->sobrenome)
                ->exists()) {
            return back()->withErrors([
                'nome_completo' => 'Este nome e sobrenome já estão cadastrados.',
            ])->withInput();
        }
    
        // Cria a pessoa e associa os presentes selecionados
        $pessoa = Pessoa::create($request->only(['nome', 'sobrenome', 'email']));
    
        // Associa os presentes (se houver seleção)
        if ($request->has('gifts')) {
            $pessoa->gifts()->attach($request->input('gifts'));
        }
    
        return redirect()->route('home')->with('success', 'Participante cadastrado com sucesso!');
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
        $gifts = Gift::all(); // Carrega todos os gifts disponíveis
        return view('pessoa.edit', compact('pessoa', 'gifts'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valida os dados recebidos
        $request->validate([
            'nome' => 'required|min:3',
            'sobrenome' => 'required|min:3',
            'email' => 'required|email',
            'gifts' => 'array' // Se gifts é um array
        ]);
    
        // Obtém a pessoa a ser atualizada
        $pessoa = Pessoa::findOrFail($id);
    
        // Verifica se já existe uma combinação de nome e sobrenome, ignorando a pessoa atual
        if (Pessoa::where('nome', $request->nome)
                ->where('sobrenome', $request->sobrenome)
                ->where('id', '!=', $pessoa->id) // Ignora a própria pessoa
                ->exists()) {
            return back()->withErrors([
                'nome_completo' => 'Este nome e sobrenome já estão cadastrados.',
            ])->withInput();
        }
    
        // Atualiza os dados da pessoa
        $pessoa->nome = $request->nome;
        $pessoa->sobrenome = $request->sobrenome;
        $pessoa->email = $request->email;
    
        // Atualiza os gifts (se necessário)
        $pessoa->gifts()->sync($request->input('gifts', [])); // Atualiza os gifts associados
    
        $pessoa->save();
    
        return redirect()->route('home')->with('success', 'Participante atualizado com sucesso!');
    }
    

        
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();
    
        return redirect()->route('home')->with('success', 'Participante deletado com sucesso!');
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
