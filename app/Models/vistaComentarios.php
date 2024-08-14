<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistaComentarios extends Model
{
    use HasFactory;
    protected $table = 'vistacomentarios';
    protected $primaryKey = 'idcomentarios';
    public $timestamps = false;

}