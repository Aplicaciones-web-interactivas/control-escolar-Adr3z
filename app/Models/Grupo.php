<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'horario_id'];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'inscripciones', 'grupo_id', 'usuario_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}