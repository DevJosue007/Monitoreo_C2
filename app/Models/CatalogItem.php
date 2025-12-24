<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    protected $fillable = [
        'definicion', 
        'item_etiqueta',
        'item_valor', 
        'estatus'
    ];
}
