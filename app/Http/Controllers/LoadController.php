<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Route;
use App\Models\TruckType;
use App\Models\DetailsLoad;
use Illuminate\Http\Request;
use App\Models\Product;

class LoadController extends Controller
{
    public function index()
    {
        $loads = Load::with('detailsLoads')->paginate();

        return view('load.index', compact('loads'))
            ->with('i', (request()->input('page', 1) - 1) * $loads->perPage());
    }

    public function create()
    {
        $currentLoad = Load::latest()->first();
        $load = new Load();
        $routes = Route::all();
        $truckTypes = TruckType::all();
        $products = Product::all();
        $detailsLoad = DetailsLoad::all();

        return view('load.create', compact('currentLoad', 'load', 'routes', 'truckTypes', 'detailsLoad', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'routes_id' => 'required|integer',
            'truck_types_id' => 'required|integer',
            'detalles' => 'required|array',
            'detalles.*.amount' => 'required|numeric',
            'detalles.*.products_id' => 'required|integer',
        ]);

        try {
            $load = Load::create([
                'date' => $request->input('date'),
                'routes_id' => $request->input('routes_id'),
                'truck_types_id' => $request->input('truck_types_id'),
            ]);

            foreach ($request->input('detalles') as $detalle) {
                $load->detailsLoads()->create([
                    'amount' => $detalle['amount'],
                    'products_id' => $detalle['products_id'],
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Carga creada exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        $load = Load::findOrFail($id);
        $routes = Route::all();
        $truckTypes = TruckType::all();
        $detailsLoads = DetailsLoad::where('loads_id', $id)->get();
        $products = Product::all(); // Asegúrate de importar el modelo Product y obtener todos los productos

         // Obtener los IDs de los productos que ya están asociados a esta carga
        $selectedProductIds = $detailsLoads->pluck('products_id')->toArray();

        $currentTime = now();
        $createdAt = $load->created_at;
        $differenceInHours = $currentTime->diffInHours($createdAt);
        $isPastDate = $load->date < $currentTime->format('Y-m-d');

        if ($differenceInHours >= 24 || $isPastDate) {
            return redirect()->route('loads.index')
                ->with('error', 'No puedes editar esta carga porque han pasado más de 24 horas desde su registro o la fecha de la carga ya ha pasado.');
        }

        return view('load.edit', compact('load', 'routes', 'truckTypes', 'detailsLoads', 'products'));
    }

    public function update(Request $request, Load $load)
    {
        $request->validate([
            'date' => 'required|date',
            'routes_id' => 'required|integer',
            'truck_types_id' => 'required|integer',
            'details_loads' => 'required|array',
            'details_loads.*.amount' => 'required|numeric',
            'details_loads.*.products_id' => 'required|integer',
        ]);

        foreach ($request->input('details_loads') as $key => $detail) {
            $request->merge([
                "details_loads.$key.amount" => is_array($detail['amount']) ? '' : (string)$detail['amount'],
                "details_loads.$key.products_id" => is_array($detail['products_id']) ? '' : (string)$detail['products_id'],
            ]);
        }

        $load->update($request->all());

        $load->detailsLoads()->delete();

        foreach ($request->input('details_loads') as $detail) {
            $detailLoad = new DetailsLoad();
            $detailLoad->amount = $detail['amount'];
            $detailLoad->products_id = $detail['products_id'];
            $detailLoad->loads_id = $load->id;
            $detailLoad->save();
        }

        return redirect()->route('loads.index')->with('success', 'Carga actualizada exitosamente.');
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|boolean',
    ]);

    $load = Load::findOrFail($id);
    $load->enabled = $request->input('status');
    $load->save();

    $action = $load->enabled ? 'habilitado' : 'inhabilitado';

    return redirect()->route('loads.index')->with('success', "La carga ha sido $action correctamente.");
}


    public function destroy($id)
    {
        Load::findOrFail($id)->delete();

        return redirect()->route('loads.index')
            ->with('success', 'Carga eliminada exitosamente');
    }

    public function show($id)
    {
        $load = Load::findOrFail($id);

        return view('load.show', compact('load'));
    }
}
