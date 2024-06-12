<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
use App\Models\Route;
use Illuminate\Http\Request;



class CustomerController extends Controller
{
    public function index(Request $request)
{
    // Obtener el valor de la búsqueda del request
    $busqueda = $request->input('busqueda');

    // Realizar la búsqueda de los clientes
    $customers = Customer::with('route')
        ->where(function($query) use ($busqueda) {
            $query->where('customer_name', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('company_name', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('cell_phone', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('mail', 'LIKE', '%' . $busqueda . '%');
        })
        ->orWhereHas('route', function($query) use ($busqueda) {
            $query->where('route_name', 'LIKE', '%' . $busqueda . '%');
        })
        ->orderBy('enabled', 'desc') // Los habilitados primero
        ->orderBy('created_at', 'asc') // Luego por fecha de creación
        ->paginate(10);

    // Pasar los datos a la vista
    return view('customer.index', compact('customers', 'busqueda'))
        ->with('i', ($customers->currentPage() - 1) * $customers->perPage());
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

    // Validar el formato del correo electrónico
    if (!preg_match('/^\S+@(gmail\.com|hotmail\.com)$/i', $validatedData['mail'])) {
        return redirect()->route('customer.create')
            ->withErrors(['mail' => 'El formato del correo electrónico no es válido.'])
            ->withInput();
    }

    $existingPhone = Customer::where('cell_phone', $validatedData['cell_phone'])->first();
    if ($existingPhone) {
        return redirect()->route('customer.create')
            ->withErrors(['cell_phone' => 'El número de teléfono ya está en uso.'])
            ->withInput();
    }

    $existingEmail = Customer::where('mail', $validatedData['mail'])->first();
    if ($existingEmail) {
        return redirect()->route('customer.create')
            ->withErrors(['mail' => 'El correo electrónico ya está en uso.'])
            ->withInput();
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
        'status' => 'required|boolean', // Asegura que 'status' sea un valor booleano
    ]);

    $customer = Customer::findOrFail($id);
    $customer->enabled = $request->input('status');
    $customer->save();

    $action = $customer->enabled ? 'habilitado' : 'inhabilitado';

    return redirect()->route('customer.index')->with('success', "El cliente ha sido $action correctamente.");
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