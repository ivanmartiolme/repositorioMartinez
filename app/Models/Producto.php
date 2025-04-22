<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = ['nombre', 'precio', 'categoria'];
}
