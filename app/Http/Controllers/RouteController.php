<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Departament;
use App\Models\Employee;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Requests\RouteRequest;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::all();
        foreach ($routes as $route) {
            $route->municipalities = $route->municipalities ? json_decode($route->municipalities) : [];
        }
    
        return view('route.index', compact('routes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $departaments = Departament::all();
    $municipalities = Municipality::all();

    return view('route.create', compact('departaments', 'municipalities'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'departament_id' => 'required|integer',
            'municipalities' => 'required|array',
            'municipalities.*' => 'string'
        ]);
    
        $route = new Route();
        $route->route_name = $request->route_name;
        $route->departament_id = $request->departament_id;
        $route->municipalities = json_encode($request->municipalities);
        $route->save();
    
        return redirect()->route('route.index')->with('success', 'Ruta creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $route = Route::find($id);

        return view('route.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $route = Route::findOrFail($id);
    $departaments = Departament::all();
    $municipalities = Municipality::all();
    $route->municipalities = json_decode($route->municipalities, true);

    return view('route.edit', compact('route', 'departaments', 'municipalities'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'departament_id' => 'required|integer',
            'municipalities' => 'required|array',
            'municipalities.*' => 'string'
        ]);
    
        $route = Route::findOrFail($id);
        $route->route_name = $request->route_name;
        $route->departament_id = $request->departament_id;
        $route->municipalities = json_encode($request->municipalities);
        $route->save();
    
        return redirect()->route('route.index')->with('success', 'Ruta actualizada con éxito');
    }



}
