<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistaTickets extends Model
{
    use HasFactory;
    protected $table = 'vistatickets';
    protected $primaryKey = 'ID_tickets';
    public $timestamps = false;
}
