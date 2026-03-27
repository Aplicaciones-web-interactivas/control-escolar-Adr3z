<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'clave_institucional',
        'contrasena',
        'rol',
        'activo',
    ];

    protected $hidden = ['contrasena', 'remember_token'];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    // Laravel usa este método para verificar la contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'usuario_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'usuario_id');
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'inscripciones', 'usuario_id', 'grupo_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'usuario_id');
    }
}