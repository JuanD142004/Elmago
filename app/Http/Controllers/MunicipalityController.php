<?php

namespace App\Http\Controllers;
use App\Models\Departament;
use App\Models\Municipality;
use App\Http\Requests\MunicipalityRequest;

/**
 * Class MunicipalityController
 * @package App\Http\Controllers
 */
class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipalities = Municipality::paginate(10000); // 10 es el número de elementos por página, puedes ajustarlo según tus necesidades
        return view('municipality.index', compact('municipalities'));
    }
    

    /**
     * Show the form for creating a new resource.
     */

    
    public function create()
        {
            $municipality = new Municipality();
            $departaments = Departament::all(); // Obtén todos los departamentos
            return view('municipality.create', compact('municipality', 'departaments'));
        }
    
        // Otros métodos del controlador...
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipalityRequest $request)
    {
        Municipality::create($request->validated());

        return redirect()->route('municipality.index')
            ->with('success', 'Municipality created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $municipality = Municipality::find($id);

        return view('municipality.show', compact('municipality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $municipality = Municipality::find($id);

        return view('municipality.edit', compact('municipality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MunicipalityRequest $request, Municipality $municipality)
    {
        $municipality->update($request->validated());

        return redirect()->route('municipalities.index')
            ->with('success', 'Municipality updated successfully');
    }

    public function destroy($id)
    {
        Municipality::find($id)->delete();

        return redirect()->route('municipalities.index')
            ->with('success', 'Municipality deleted successfully');
    }
}
