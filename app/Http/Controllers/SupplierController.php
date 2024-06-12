<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Importa Rule para la validación de unicidad



class SupplierController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los proveedores sin importar su estado
        $suppliers = Supplier::withoutGlobalScope(\App\Scopes\EnabledScope::class)
            ->orderBy('enabled', 'desc')
            ->orderBy('supplier_name')
            ->paginate();

            
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
    // Normalizar entradas
    $input = $request->all();
    $input['nit'] = preg_replace('/\s+/', '', $input['nit']);
    $input['cell_phone'] = preg_replace('/\s+/', '', $input['cell_phone']);
    $input['mail'] = trim($input['mail']);

    $validator = Validator::make($input, [
        'nit' => 'required|numeric|unique:suppliers,nit',
        'supplier_name' => 'required|string|max:255',
        'cell_phone' => 'required|numeric|digits:10|unique:suppliers,cell_phone',
        'mail' => [
            'required',
            'email:rfc,dns',
            Rule::unique('suppliers')->where(function ($query) use ($input) {
                return $query->where('mail', $input['mail']);
            })
        ],
        'address' => 'required|string|max:255',
    ], [
        'nit.required' => 'El NIT es obligatorio.',
        'nit.numeric' => 'El NIT debe ser un número.',
        'nit.unique' => 'El NIT ya está registrado.',
        'supplier_name.required' => 'El nombre del proveedor es obligatorio.',
        'cell_phone.required' => 'El número de teléfono es obligatorio.',
        'cell_phone.numeric' => 'El número de teléfono debe ser numérico.',
        'cell_phone.digits' => 'El número de teléfono debe tener 10 dígitos.',
        'cell_phone.unique' => 'El número de teléfono ya está registrado.',
        'mail.required' => 'El correo electrónico es obligatorio.',
        'mail.email' => 'El correo electrónico debe ser una dirección válida.',
        'mail.unique' => 'El correo electrónico ya está registrado.',
        'address.required' => 'La dirección es obligatoria.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    Supplier::create($input);

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
        // Normalizar entradas
        $input = $request->all();
        $input['nit'] = preg_replace('/\s+/', '', $input['nit']);
        $input['cell_phone'] = preg_replace('/\s+/', '', $input['cell_phone']);
        $input['mail'] = trim($input['mail']);

        $validator = Validator::make($input, [
            'nit' => [
                'required',
                'numeric',
                Rule::unique('suppliers')->ignore($supplier->id),
            ],
            'supplier_name' => 'required|string|max:255',
            'cell_phone' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('suppliers')->ignore($supplier->id),
            ],
            'mail' => [
                'required',
                'email:rfc,dns',
                Rule::unique('suppliers')->ignore($supplier->id)->where(function ($query) use ($input) {
                    return $query->where('mail', $input['mail']);
                })
            ],
            'address' => 'required|string|max:255',
        ], [
            'nit.required' => 'El NIT es obligatorio.',
            'nit.numeric' => 'El NIT debe ser un número.',
            'nit.unique' => 'El NIT ya está registrado.',
            'supplier_name.required' => 'El nombre del proveedor es obligatorio.',
            'cell_phone.required' => 'El número de teléfono es obligatorio.',
            'cell_phone.numeric' => 'El número de teléfono debe ser numérico.',
            'cell_phone.digits' => 'El número de teléfono debe tener 10 dígitos.',
            'cell_phone.unique' => 'El número de teléfono ya está registrado.',
            'mail.required' => 'El correo electrónico es obligatorio.',
            'mail.email' => 'El correo electrónico debe ser una dirección válida.',
            'mail.unique' => 'El correo electrónico ya está registrado.',
            'address.required' => 'La dirección es obligatoria.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supplier->update($input);

        return redirect()->route('supplier.index')
            ->with('success', 'Proveedor actualizado con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $supplier = Supplier::withoutGlobalScope(\App\Scopes\EnabledScope::class)->findOrFail($id);
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
