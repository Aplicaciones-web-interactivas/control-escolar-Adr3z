<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['grupo_id', 'titulo', 'descripcion', 'fecha_entrega'];

    protected $casts = [
        'fecha_entrega' => 'date',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}