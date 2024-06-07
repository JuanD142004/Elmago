<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Importa Rule para la validación de unicidad

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::paginate();
        return view('supplier.index', compact('suppliers'))
            ->with('i', (request()->input('page', 1) - 1) * $suppliers->perPage());
    }

    public function create()
    {
        $supplier = new Supplier();
        return view('supplier.create', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nit' => 'required|unique:suppliers,nit',
            
            'supplier_name'=>'required:suppliers,supplier_name',
            'cell_phone' => 'required|unique:suppliers,cell_phone',
            'mail' => 'required|email|unique:suppliers,mail',
            'address' => 'required:suppliers,address',
            // otras reglas de validación
        ], [
            'nit.required' => 'El NIT es obligatorio.',
            'nit.unique' => 'El NIT ya está registrado.',
            'cell_phone.required' => 'El número de teléfono es obligatorio.',
            'cell_phone.unique' => 'El número de teléfono ya está registrado.',
            'mail.required' => 'El correo electrónico es obligatorio.',
            'mail.email' => 'El correo electrónico debe ser una dirección válida.',
            'mail.unique' => 'El correo electrónico ya está registrado.',
            'address.required' => 'La direccion es obligatorio.',
            // otros mensajes de validación
        ]);
    
        $supplier = Supplier::create($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Proveedor creado con éxito.');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nit' => [
                'required',
                Rule::unique('suppliers')->ignore($supplier->id),
            ],
            'cell_phone' => [
                'required',
                Rule::unique('suppliers')->ignore($supplier->id),
            ],
            'mail' => [
                'required',
                'email',
                Rule::unique('suppliers')->ignore($supplier->id),
            ],
            // otras reglas de validación
        ], [
            'nit.required' => 'El NIT es obligatorio.',
            'nit.unique' => 'El NIT ya está registrado.',
            'cell_phone.required' => 'El número de teléfono es obligatorio.',
            'cell_phone.unique' => 'El número de teléfono ya está registrado.',
            'mail.required' => 'El correo electrónico es obligatorio.',
            'mail.email' => 'El correo electrónico debe ser una dirección válida.',
            'mail.unique' => 'El correo electrónico ya está registrado.',
            // otros mensajes de validación
        ]);
    
        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Proveedor actualizado con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->enabled = $request->input('status');
        $supplier->save();

        $action = $supplier->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El proveedor ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id)->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Proveedor eliminado con éxito');
    }
}
