<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\AuxiliarController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\Auth\CambiarContrasenaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
/*
Route::resource('jefe', TicketController::class);
Route::resource('cliente', TicketController::class); */


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/update-photo', [CambiarContrasenaController::class, 'updatePhoto'])->name('updatePhoto');
// Rutas para comentarios
Route::get('/comentarios/ticket/{id}', [ComentarioController::class, 'obtenerComentariosPorTicket']);
Route::post('/comentarios/crear', [ComentarioController::class, 'crearComentario'])->name('comentarios.crear');


Route::middleware(['auth', 'checkrole:Jefe'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('jefe', JefeController::class);
    Route::resource('departamento', DepartamentoController::class);
    Route::post('/tickets/asignar/{ticket}', [TicketController::class, 'asignarAuxiliar'])->name('asignarAuxiliar');
    Route::resource('ticketJefe', TicketController::class);
    Route::resource('perfilJefe', ProfileController::class);
    Route::get('/changePasswordJ', [CambiarContrasenaController::class, 'index'])->name('vistaCambioContraJefe');
    Route::post('/changePasswordJ', [CambiarContrasenaController::class, 'store'])->name('cambiarContraJefe');
    Route::get('/imprimirTickets', [JefeController::class, 'imprimirTickets'])->name('imprimirTickets');
    Route::get('/imprimirTicketsDepartamentos', [JefeController::class, 'imprimirTicketsDepartamentos'])->name('imprimirTicketsDepartamentos');
    Route::get('/imprimirTicketsAuxiliar', [JefeController::class, 'imprimirTicketsAuxiliar'])->name('imprimirTicketsAuxiliar');
    Route::post('/imprimirTicketsFecha', [JefeController::class, 'imprimirTicketsFecha'])->name('imprimirTicketsFecha');
});

Route::middleware(['auth', 'checkrole:Auxiliar'])->group(function () {
    Route::resource('auxiliar', AuxiliarController::class);
    Route::resource('ticketAux', TicketController::class);
    Route::post('ticketAux/{ID_tickets}/actualizarEstatus', [TicketController::class, 'actualizarEstatus'])->name('ticketAux.actualizarEstatus');
    Route::get('/changePasswordA', [CambiarContrasenaController::class, 'index'])->name('vistaCambioContraAux');
    Route::post('/changePasswordA', [CambiarContrasenaController::class, 'store'])->name('cambiarContraAux');
    Route::get('/imprimirTicketsDepartamentos', [AuxiliarController::class, 'imprimirTicketsDepartamentos'])->name('imprimirTicketsDepartamentos');
    Route::get('/imprimirTicketsAuxiliar', [AuxiliarController::class, 'imprimirTicketsAuxiliar'])->name('imprimirTicketsAuxiliar');
    Route::post('/imprimirTicketsFecha', [AuxiliarController::class, 'imprimirTicketsFecha'])->name('imprimirTicketsFecha');
    Route::get('/imprimirTicketsEstatus', [AuxiliarController::class, 'imprimirTicketsEstatus'])->name('imprimirTicketsEstatus');
});

Route::middleware(['auth', 'checkrole:Cliente'])->group(function () {
    Route::resource('cliente', ClienteController::class);
    Route::resource('ticketCliente', TicketController::class);
    Route::resource('perfilCliente', ProfileController::class);
    Route::get('/changePassword', [CambiarContrasenaController::class, 'index'])->name('vistaCambioContra');
    Route::post('/changePassword', [CambiarContrasenaController::class, 'store'])->name('cambiarContra');
});



