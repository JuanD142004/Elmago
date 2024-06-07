<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Supplier;


/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $products = Product::where('product_name', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('brand', 'LIKE', '%' . $busqueda . '%')
                                ->orderBy('id', 'asc')
                                ->paginate();
    
        return view('product.index', compact('products', 'busqueda'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $suppliers = Supplier::all();
        return view('product.create', compact('product','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'brand' => 'required',
            'price_unit' => 'required|required',
            'unit_of_measurement' => 'required',
            'suppliers_id' => 'required|exists:suppliers,id',
            // otras reglas de validación
        ], [
            'product_name.required' => 'El nombre del producto es obligatorio.',
            'brand.required' => 'La marca es obligatoria.',
            'price_unit.required' => 'El precio unitario es obligatorio.',
            'unit_of_measurement.required' => 'La unidad de medida es obligatoria.',
            'suppliers_id.required' => 'El proveedor es obligatorio.',
            'suppliers_id.exists' => 'El proveedor seleccionado no es válido.',
            // otros mensajes de validación
        ]);

        $product = Product::create($request->all());
        return redirect()->route('product.index')
            ->with('success', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $suppliers = Supplier::all();
        return view('product.edit', compact('product','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('product.index')
            ->with('success', 'Producto actualizado con éxito');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean', // Asegura que 'status' sea un valor booleano
        ]);

        $product = Product::findOrFail($id);
        $product->enabled = $request->input('status');
        $product->save();

        $action = $product->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El producto ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        $product =Product::find ($id);
        if($product->enabled == 1){
            Product::where('id',$product->id)
            ->update([
                'enabled'=> 0
            ]);
        }else {
            Product::where('id', $product->id)
            ->update([
                'enabled'=>1
            ]);
        }
        $product = Product::all();
        return redirect()->route('product.index')
            ->with('success', 'Actualizacion de estado','product');
    }
}
