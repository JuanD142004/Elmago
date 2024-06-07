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
    $routes = new Route();
    $departaments = Departament::all();
    // $municipalities = Municipality::all(); // Agrega esta línea para obtener la lista de municipios
    return view('route.create', compact('routes', 'departaments'));
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
        ]);
    
        Route::create([
            'route_name' => $request->route_name,
            'departament_id' => $request->departament_id,
            'municipalities' => json_encode($request->municipalities),
        ]);
    
        return redirect()->route('route.index')
            ->with('success', 'Ruta creada exitosamente.');
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
    public function update(RouteRequest $request, Route $route)
    {
        $route->update($request->validated());

        return redirect()->route('route.index')
            ->with('success', 'route updated successfully');
    }
    public function updateStatus(Request $request, $id)
{
    $route = Route::findOrFail($id);
    $route->enabled = $request->input('status');
    $route->save();

    return redirect()->back()->with('success', 'Ruta actualizada con exito.');
}

 



}
