<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_fileable',
        'archivo_ruta',
        'archivo_nombre',
        'archivo_tipo',
        'archivo_tamanio',
        'archivo_fh'
    ];

    public function mediaFileable(){
        return $this->morphTo();
    }

}
