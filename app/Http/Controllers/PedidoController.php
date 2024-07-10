<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // v327
use Carbon\Carbon; // v329
// use Illuminate\Support\Carbon; // v329

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // almacenar una orden (INSERT en pedidos)
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id;
        $pedido->total = $request->total;
        $pedido->save(); // retorna un bool (v329)

        // obtener el id del pedido insertado
        $id = $pedido->id;

        // obtener los productos
        $productos = $request->productos; 

        // formatear un arreglo
        $pedido_producto = [];
        foreach($productos as $producto){
            $pedido_producto[] = [
                "pedido_id" => $id,
                "producto_id" => $producto["id"],
                "cantidad" => $producto["cantidad"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }

        // almacenar en la DB (INSERT masivo en pedido_productos) (v329)
        PedidoProducto::insert($pedido_producto);
        
        return [
            "message" => "Pedido realizado correctamente, estará listo en unos minutos"
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
