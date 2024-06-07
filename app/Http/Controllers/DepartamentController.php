<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Http\Requests\DepartamentRequest;
use Illuminate\Http\Request;

/**
 * Class DepartamentController
 * @package App\Http\Controllers
 */
class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departaments = Departament::paginate(100); // 10 es el número de elementos por página, puedes ajustarlo según tus necesidades
        return view('departament.index', compact('departaments'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departament = new Departament();
        return view('departament.create', compact('departament'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartamentRequest $request)
    {
        Departament::create($request->validated());

        return redirect()->route('departament.index')
            ->with('success', 'Departament created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $departament = Departament::find($id);

        return view('departament.show', compact('departament'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departament = Departament::find($id);

        return view('departament.edit', compact('departament'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartamentRequest $request, Departament $departament)
    {
        $departament->update($request->validated());

        return redirect()->route('departament.index')
            ->with('success', 'Departament updated successfully');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean', // Asegura que 'status' sea un valor booleano
        ]);

        $departament = Departament::findOrFail($id);
        $departament->enabled = $request->input('status');
        $departament->save();

        $action = $departament->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El departamento ha sido $action correctamente.");
    }
    

    public function destroy($id)
    {
        Departament::find($id)->delete();

        return redirect()->route('departament.index')
            ->with('success', 'Departament deleted successfully');
    }
    
    public function municipalities(Departament $departament){
        return response()->json($departament->municipalities);
    }
}
