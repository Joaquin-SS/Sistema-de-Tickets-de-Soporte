<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::where('estado', 'Activo')->get();
        return view('jefe.showDepa', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jefe.createDepa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar los datos del fromulario
        $validarDatos = $request->validate([
            'departamento' => 'required|string|max:200',
            'estado' => 'required',
        ]);

        //Guardar el usuario
        $depa = new Departamento;
        $depa->departamento = $validarDatos['departamento']; 
        $depa->estado = $validarDatos['estado'];
        $registrado = $depa->save();

        if ($registrado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Departamento creado correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al crear el Departamento. Por favor, intenta de nuevo.'];
        }

        return redirect('/jefe')->with('mensaje', $mensaje);
    }

    /**
     * Display the specified resource.
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$iddepartamento)
    {
        $depa = Departamento::findOrFail($iddepartamento);

        // Actualizar departamento
        $actualizado = $depa->update([
            'departamento' => $request->Departamento,
            'estado' => $request->estado,
        ]);

        if ($actualizado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Departamento modificado correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al modificar el Departamento. Por favor, intenta de nuevo.'];
        }

        return redirect('/departamento')->with('mensaje', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($departamento)
    {
        //Eliminar al departamento
        $depa = Departamento::findOrFail($departamento);

        // Actualizar departamento
        $depa->estado = 'Inactivo';
        $eliminado=$depa->save();

        if ($eliminado) {
            $mensaje = ['tipo' => 'success', 'texto' => 'Departamento eliminado correctamente.'];
        } else {
            $mensaje = ['tipo' => 'error', 'texto' => 'Error al eliminar el Departamento. Por favor, intenta de nuevo.'];
        }
        return redirect('/departamento')->with('mensaje', $mensaje);
    }
}
