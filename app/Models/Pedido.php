<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /* protected $fillable = [
        'user_id',
        'total'
    ]; */

    public function user() // v336
    {
        return $this->belongsTo(User::class);
    }
    
    // relacion de muchos a muchos enre pedidos y productos (v337)
    // 1er. param: indicamos con que otro modelo estamos estableciendo la relacion 
    // 2do. param: indicamos la tabla intermedia que conecta a pedidos y productos 
    public function productos()
    {
        return $this->belongsToMany(Producto::class, "pedido_productos")->withPivot("cantidad");
    }

}
