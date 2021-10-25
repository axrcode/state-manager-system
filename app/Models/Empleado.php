<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'nombre', 'apellido', 'dpi', 'fecha_nacimiento', 'direccion', 'telefono',
        'cargo', 'fecha_alta', 'estado', 'user_id', 'departamento_id'
    ];

    /* Relation for User of the Collaborator */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
