<?php

namespace App\Http\Controllers;

use App\Models\DetailsPurchase;
use App\Http\Requests\DetailsPurchaseRequest;
use App\Models\Product;



/**
 * Class DetailsPurchaseController
 * @package App\Http\Controllers
 */
class DetailsPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailsPurchases = DetailsPurchase::paginate();

        return view('details-purchase.index', compact('detailsPurchases'))
            ->with('i', (request()->input('page', 1) - 1) * $detailsPurchases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detailsPurchase = new DetailsPurchase();
        $products = Product::all();
        

        return view('details-purchase.create', compact('detailsPurchase','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DetailsPurchaseRequest $request)
    {
        DetailsPurchase::create($request->validated());

        return redirect()->route('details_purchase.index')
            ->with('success', 'DetailsPurchase created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detailsPurchase = DetailsPurchase::find($id);

        return view('details-purchase.show', compact('detailsPurchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detailsPurchase = DetailsPurchase::find($id);

        return view('details-purchase.edit', compact('detailsPurchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetailsPurchaseRequest $request, DetailsPurchase $detailsPurchase)
    {
        $detailsPurchase->update($request->validated());

        return redirect()->route('details_purchase.index')
            ->with('success', 'DetailsPurchase updated successfully');
    }

    public function destroy($id)
    {
        DetailsPurchase::find($id)->delete();

        return redirect()->route('details_purchase.index')
            ->with('success', 'DetailsPurchase deleted successfully');
            
    }
}
