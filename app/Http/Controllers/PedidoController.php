<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon; // v329
use Illuminate\Http\Request;
use App\Models\PedidoProducto;
use App\Http\Resources\PedidoCollection; // v336
use Illuminate\Support\Facades\Auth; // v327
// use Illuminate\Support\Carbon; // v329

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // v336
    {
        // retornamos todos los pedidos y la data del usuario propietario de cada uno de ellos // v336
        // "user" hace referencia al nombre de la relacion entre los modelos Pedido y User, definida en Pedido (v337)
        // "productos" hace referencia al nombre de la relacion entre los modelos Pedido y Prodcto, definida en Pedido (v337)
        return new PedidoCollection(Pedido::with("user")
            ->with("productos")
            ->where("estado", 0)
            ->get());
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
