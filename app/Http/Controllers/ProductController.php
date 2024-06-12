<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Supplier;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $products = Product::where('product_name_and_brand', 'LIKE', '%' . $busqueda . '%')
                            ->orderBy('id', 'asc')
                            ->paginate();
        
        return view('product.index', compact('products', 'busqueda'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    public function create()
    {
        $product = new Product();
        $suppliers = Supplier::all();
        return view('product.create', compact('product', 'suppliers'));
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('product.index')
            ->with('success', 'Producto creado con éxito.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        return view('product.edit', compact('product', 'suppliers'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        return redirect()->route('product.index')
            ->with('success', 'Producto actualizado con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);
        $product->enabled = $request->input('status');
        $product->save();

        $action = $product->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El producto ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->enabled = !$product->enabled;
        $product->save();

        return redirect()->route('product.index')
            ->with('success', 'Actualización de estado del producto realizada con éxito.');
    }
}
