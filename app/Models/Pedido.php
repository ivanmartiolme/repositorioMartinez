<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['mesa_id', 'total', 'estado'];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    // Relación con la mesa
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    
}
