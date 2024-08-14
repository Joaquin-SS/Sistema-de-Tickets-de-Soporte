<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios'; 
    protected $primaryKey = 'ID_Usuario'; 

    protected $fillable = [
        'Nombre', 'Rol', 'contrasena', 'email','departamento',
    ];

    protected $hidden = [
        'contrasena', // Oculta la contraseña en arrays y JSON
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    // Sobreescribe el método getAuthPassword para usar 'contrasena' como contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}