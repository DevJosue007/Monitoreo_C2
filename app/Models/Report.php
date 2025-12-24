<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Report extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'centro_p_id',
        'bloque_id',
        'area_id',
        'tipo_inc_id',
        'descripcion',
        'fecha_hora_inc'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function media(){
        // El 'media:fileable' es el nombre de la columna morphs que se creo en la migración
        return $this->morphMany(MediaFile::class, 'media_fileable');
    }


}
