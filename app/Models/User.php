<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabla asociada (Laravel asume 'users' por defecto, pero lo explicitamos)
    protected $table = 'users';

    // Columnas que se pueden llenar mediante formularios (CRUD / Registro)
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'id_rol',
    ];

    // Ocultar la contraseña al serializar datos por seguridad
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Castear campos de tiempo nativos si es necesario
    protected $casts = [
        'email_verified_at' => 'timestamp',
        'password' => 'hashed', // Encriptación automática al validar
    ];

    /**
     * Relación con la tabla Roles
     * Un usuario pertenece a un Rol específico
     */
    public function rol()
    {
        return $this->belongsTo(Role::class, 'id_rol', 'id_rol');
    }
}