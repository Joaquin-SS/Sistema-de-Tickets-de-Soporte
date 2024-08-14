<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $primaryKey = 'idcomentarios';
    public $timestamps = false;

    protected $fillable = [
        'comentario',
        'fecha_hora',
        'destinatario',
        'ID_Usuario',
        'ID_tickets'
    ];
}
