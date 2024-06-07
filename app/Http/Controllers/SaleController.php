<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\DetailsSale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Form;

use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales = Sale::with('customer')->paginate(1000);

        return view('sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale = new Sale();
        $detailsSale = new DetailsSale();
        $products = Product::all();
        $customers = Customer::all('id', 'customer_name');

        return view('sale.create', compact('sale', 'detailsSale', 'products', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Obtener los datos enviados desde el formulario
            $data = $request->input('data');

            // Crear una nueva venta
            $venta = new Sale();
            $venta->customers_id = $data['customers_id'];
            $venta->price_total = preg_replace('/[^\d]/', '', $data['price_total']); // Remover formateo
            $venta->payment_method = $data['payment_method'];
            $venta->enabled = true; // Marcar la venta como habilitada
            $venta->save();

            // Recorrer y guardar los detalles de la venta en la base de datos
            foreach ($data['detalles'] as $detalle) {
                $detalleVenta = new DetailsSale();
                $detalleVenta->products_id = $detalle['products_id'];
                $detalleVenta->price_unit = preg_replace('/[^\d]/', '', $detalle['price_unit']); // Remover formateo
                $detalleVenta->amount = $detalle['amount'];
                $detalleVenta->discount = $detalle['discount'] ?? 0; // Valor predeterminado de descuento
                $detalleVenta->sales_id = $venta->id; // Asociar el detalle con la venta creada
                $detalleVenta->save();
            }

            // Retornar una respuesta de éxito
            return redirect()->route('sales.index')->with('success', 'Venta creada exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier excepción que ocurra durante el proceso
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::with('detailsSales')->findOrFail($id);

        return view('sale.show', compact('sale'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);

        return view('sale.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customers_id' => 'required',
            'price_total' => 'required',
            'payment_method' => 'required',
        ]);

        // Añade manejo de errores para capturar cualquier excepción durante la actualización
        try {
            $sale->update($request->all());
            return redirect()->route('sales.index')->with('success', 'Venta actualizada exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating sale: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Añade manejo de errores para capturar cualquier excepción durante la eliminación
        try {
            Sale::find($id)->delete();
            return redirect()->route('sales.index')->with('success', 'Venta eliminada exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error deleting sale: ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle the enabled status of the specified sale.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->enabled = !$sale->enabled;
        $sale->save();

        return redirect()->route('sales.index')->with('success', 'Estado de venta cambiado correctamente.');
    }

    /**
     * Search for a specific resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $sales = Sale::where('customers_id', 'like', '%' . $query . '%')
            ->orWhere('price_total', 'like', '%' . $query . '%')
            ->orWhere('payment_method', 'like', '%' . $query . '%')
            ->paginate(10);

        return view('sale.index', compact('sales'));
    }
}
