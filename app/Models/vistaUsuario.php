<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistaUsuario extends Model
{
    use HasFactory;
    protected $table = 'vistausuarios';
    protected $primaryKey = 'ID_Usuarios';
    public $timestamps = false;

}
