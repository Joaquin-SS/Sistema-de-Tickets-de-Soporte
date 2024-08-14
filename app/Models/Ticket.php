<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey = 'ID_tickets';
    public $timestamps = false;

    //Permitir la actualización masivamente
    protected $fillable = [
        'Clasificacion',
        'Detalles',
        'fecha',
    ];
}
