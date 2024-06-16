<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
use App\Models\Route;
use Illuminate\Http\Request;



class CustomerController extends Controller
{
    public function index(Request $request) // Asegúrate de recibir $request como parámetro
    {
        // Obtener todos los proveedores sin importar su estado
        $customers = Customer::withoutGlobalScope(\App\Scopes\EnabledScope::class)
            ->orderBy('enabled', 'desc')
            ->orderBy('customer_name')
            ->paginate();

            
        return view('customer.index', compact('customers'))
            ->with('i', (request()->input('page', 1) - 1) * $customers->perPage());
    }

    public function create()
    {
    $customer = new Customer();
    $routes = Route::all(); // Obtener todas las rutas
    ($routes); // Debugging: Verifica si obtienes datos de rutas
    return view('customer.create', compact('customer', 'routes'));
    }

    public function store(CustomerRequest $request)
    {
        // Validar si el número de teléfono o correo electrónico ya están en uso
        $validatedData = $request->validated();
        $existingCustomer = Customer::where('cell_phone', $validatedData['cell_phone'])
                                    ->orWhere('mail', $validatedData['mail'])
                                    ->first();
        
        if ($existingCustomer) {
            return redirect()->route('customer.create')
                ->with('error', 'El número de teléfono o correo electrónico ya están en uso.');
        }
    
        // Crear el cliente si no hay problemas de duplicados
        Customer::create($validatedData);
    
        return redirect()->route('customer.index')
            ->with('success', 'Cliente creado exitosamente.');
    }
    

    public function show($id)
    {
        $customer = Customer::find($id);

        return view('customer.show', compact('customer'));
    }

    public function edit($id)
{
    $customer = Customer::find($id);
    $routes = Route::all(); // Obtener todas las rutas

    return view('customer.edit', compact('customer', 'routes'));
}
    public function update(CustomerRequest $request, Customer $customer)
{
    $customer->update($request->validated());

    return redirect()->route('customer.index')
        ->with('success', 'Cliente actualizado correctamente');
}
public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $customer = Customer::withoutGlobalScope(\App\Scopes\EnabledScope::class)->findOrFail($id);
        $customer->enabled = $request->input('status');
        $customer->save();

        $action = $customer->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El proveedor ha sido $action correctamente.");
    }


    public function destroy($id)
    {
        Customer::find($id)->delete();

        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully');
    }
    public function enable($id)
{
    $customer = Customer::find($id);
    
    if (!$customer) {
        return redirect()->route('customer.index')->with('error', 'Customer not found');
    }

    $customer->update(['enabled' => true]);

    return redirect()->route('customer.index')->with('success', 'Customer enabled successfully');
}

public function disable($id)
{
    $customer = Customer::find($id);
    
    if (!$customer) {
        return redirect()->route('customer.index')->with('error', 'Customer not found');
    }

    $customer->update(['enabled' => false]);

    return redirect()->route('customer.index')->with('success', 'Customer disabled successfully');
}


}