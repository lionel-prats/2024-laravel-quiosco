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

}
