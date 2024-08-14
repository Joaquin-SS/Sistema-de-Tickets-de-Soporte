@extends('layouts.appJefe')

@section('content')

@if(session('error'))
    <div class="alert alert-warning" role="alert">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<form action="{{ url('/perfilJefe/' . $usuario->ID_Usuario) }}" method="post" onsubmit="showSpinners()">
    @csrf
    @method('PUT') <!-- Importante: Este método es para indicar que es una actualización -->

    <!-- Mostrar la información NO EDITABLE -->
    <div>ID Usuario: {{ $usuario->ID_Usuario }}</div>
    <div>Empleado: {{ $usuario->Nombre }}</div>

    <!-- Mostrar información EDITABLE -->
    <div>
        <select name="Departamento" id="Departamento" required>
            <option value=1 {{ $usuario->departamento == 1 ? 'selected' : '' }}>Compras</option>
            <option value=2 {{ $usuario->departamento == 2 ? 'selected' : '' }}>Contabilidad</option>
            <option value=3 {{ $usuario->departamento == 3 ? 'selected' : '' }}>Logística</option>
            <option value=4 {{ $usuario->departamento == 4 ? 'selected' : '' }}>Producción</option>
            <option value=5 {{ $usuario->departamento == 5 ? 'selected' : '' }}>Ventas</option>
            <option value=6 {{ $usuario->departamento == 6 ? 'selected' : '' }}>Soporte</option>
        </select>
    </div>

    <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required>
    </div>

    <div>
        <label for="current_password">Confirmar Contraseña Actual:</label>
        <input type="password" name="current_password" id="current_password" required>
    </div>

    <input type="submit" value="Actualizar">
</form>
@endsection