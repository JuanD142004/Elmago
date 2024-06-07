<?php

namespace App\Http\Controllers;

use App\Models\DetailsSale;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailsSaleController extends Controller
{
    public function index()
    {
        $detailsSales = DetailsSale::paginate(2);

        return view('details-sale.index', compact('detailsSales'))
            ->with('i', (request()->input('page', 1) - 1) * $detailsSales->perPage());
    }

    public function create()
    {
        $detailsSale = new DetailsSale();
        $products = $this->getProducts();
        return view('details-sale.create', compact('detailsSale', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products_id' => 'required|exists:products,id',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'sales_id' => 'required|exists:sales,id', // Ajustar esta validación según tus necesidades
        ]);

        $detailsSale = new DetailsSale();
        $detailsSale->products_id = $request->products_id;
        $detailsSale->amount = $request->amount;
        $detailsSale->discount = $request->discount;
        $detailsSale->sales_id = $request->sales_id; // Asociar el sales_id proporcionado
        $detailsSale->save();

        return redirect()->route('details_sale.index')->with('success', 'DetailsSale created successfully.');
    }

    public function show($id)
    {
        $detailsSale = DetailsSale::find($id);

        return view('details-sale.show', compact('detailsSale'));
    }

    public function edit($id)
    {
        $detailsSale = DetailsSale::find($id);
        $products = $this->getProducts();
        return view('details-sale.edit', compact('detailsSale', 'products'));
    }

    public function update(Request $request, DetailsSale $detailsSale)
    {
        $request->validate(DetailsSale::$rules);

        $detailsSale->update($request->all());

        return redirect()->route('details_sale.index')
            ->with('success', 'DetailsSale updated successfully');
    }

    public function destroy($id)
    {
        $detailsSale = DetailsSale::find($id);

        if ($detailsSale) {
            $detailsSale->delete();
            return redirect()->route('details_sale.index')->with('success', 'DetailsSale deleted successfully');
        } else {
            return redirect()->route('details_sale.index')->with('error', 'DetailsSale not found');
        }
    }

    private function getProducts()
    {
        return Product::select('id', 'product_name', 'price_unit')->get();
    }
}
