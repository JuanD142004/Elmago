<?php

namespace App\Http\Controllers;

use App\Models\TruckType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TruckTypeController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $truckTypes = TruckType::where('truck_brand', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('plate', 'LIKE', '%' . $busqueda . '%')
                                ->orderBy('id', 'asc')
                                ->paginate();
    
        return view('truck-type.index', compact('truckTypes', 'busqueda'))
            ->with('i', (request()->input('page', 1) - 1) * $truckTypes->perPage());
    }

    public function create()
    {
        $truckType = new TruckType();
        return view('truck-type.create', compact('truckType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'truck_brand' => 'required',
            'plate' => 'required|unique:truck_types,plate',
            'ability' => 'required',
            'enabled' => 'required',
        ], [
            'truck_brand.required' => 'El campo Marca de Camión es obligatorio.',
            'plate.required' => 'El campo Placa es obligatorio.',
            'plate.unique' => 'La placa ya está en uso.',
            'ability.required' => 'El campo Capacidad es obligatorio.',
            'enabled.required' => 'El campo Enabled es obligatorio.',
        ]);

        TruckType::create($request->all());

        return redirect()->route('truck_type.index')
            ->with('success', 'Tipo de Camión Creado Exitosamente');
    }

    public function show($id)
    {
        $truckType = TruckType::find($id);

        return view('truck-type.show', compact('truckType'));
    }

    public function edit($id)
    {
        $truckType = TruckType::find($id);

        return view('truck-type.edit', compact('truckType'));
    }

    public function update(Request $request, TruckType $truckType)
    {
        $messages = [
            'truck_brand.required' => 'El campo Marca de Camión es obligatorio.',
            'plate.required' => 'El campo Placa es obligatorio.',
            'plate.unique' => 'La placa ya está en uso.',
            'ability.required' => 'El campo Capacidad es obligatorio.',
            'enabled.required' => 'El campo Enabled es obligatorio.',
        ];

        $request->validate([
            'truck_brand' => 'required',
            'plate' => ['required', Rule::unique('truck_types')->ignore($truckType->id)],
            'ability' => 'required',
            'enabled' => 'required',
        ], $messages);

        $truckType->update($request->all());

        return redirect()->route('truck_type.index')
            ->with('success', 'TruckType updated successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);
    
        $truckType = TruckType::findOrFail($id);
        $truckType->enabled = $request->input('status');
        $truckType->save();
    
        $action = $truckType->enabled ? 'habilitado' : 'inhabilitado';
    
        return redirect()->route('truck_type.index')->with('success', "El Camión ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        TruckType::find($id)->delete();

        return redirect()->route('truck_type.index')
            ->with('success', 'TruckType deleted successfully');
    }

    public function disable($id)
    {
        $truckType = TruckType::findOrFail($id);
        $truckType->enabled = false;
        $truckType->save();

        return redirect()->route('truck_type.index')->with('success', 'Tipo de Camión inhabilitado exitosamente');
    }

    public function enable($id)
    {
        $truckType = TruckType::findOrFail($id);
        $truckType->enabled = true;
        $truckType->save();

        return redirect()->route('truck_type.index')->with('success', 'Tipo de Camión habilitado exitosamente');
    }
}
