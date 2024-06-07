<?php

namespace App\Http\Controllers;

use App\Models\DetailsSale;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalVentasHoy = Sale::whereDate('created_at', Carbon::today())->sum('price_total');

        // Contar la cantidad de ventas realizadas hoy
        $cantidadVentasHoy = Sale::whereDate('created_at', Carbon::today())->count();

        $proveedorConMasCompras = Supplier::withCount(['purchases' => function ($query) {
            $query->select(DB::raw('count(*)'));
        }])
            ->orderBy('purchases_count', 'desc')
            ->first();

        // Obtener el producto con más ventas
        $productoConMasVentas = DetailsSale::select('products_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('products_id')
            ->orderBy('total_amount', 'desc')
            ->first();

        // Obtener los detalles del producto con más ventas
        $productoConMasVentasDetalles = null;
        if ($productoConMasVentas) {
            $productoConMasVentasDetalles = Product::find($productoConMasVentas->products_id);
        }

        // Obtener las compras realizadas hoy
        $comprasHoy = Purchase::whereDate('created_at', Carbon::today())->paginate(10);
        $ventasHoy = Sale::whereDate('created_at', Carbon::today())->paginate(10);
        return view('home', compact('ventasHoy','comprasHoy','totalVentasHoy', 'proveedorConMasCompras', 'productoConMasVentasDetalles', 'productoConMasVentas', 'cantidadVentasHoy'));
    }
}
