@extends('layouts.appJefe')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Nuevo Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}" class="was-validated" onsubmit="showSpinners()">
                        @csrf
                        
                        <!-- Nombre -->
                        <div class="row mb-3">
                            <label for="Nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre Completo') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="Nombre" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    El Nombre Completo es requerido.
                                </div>
                            </div>
                        </div>

                        <!-- Departamento -->
                        <div class="row mb-3">
                            <label for="departamento" class="col-md-4 col-form-label text-md-end">Departamento</label>
                            <div class="col-md-6">
                                <select name="departamento" id="departamento" class="form-select" required>
                                    <option value="">Seleccione el Departamento del Usuario</option>
                                    <option value=1>Compras</option>
                                    <option value=2>Contabilidad</option>
                                    <option value=3>Logística</option>
                                    <option value=4>Producción</option>
                                    <option value=5>Ventas</option>
                                    <option value=6>Soporte</option>
                                </select>
                                <div class="invalid-feedback">
                                    El Departamento es requerido.
                                </div>
                            </div>
                        </div>

                        <!-- Rol -->
                        <input type="hidden" id="RolHidden" name="Rol">
                        <div class="row mb-3">
                            <label for="Rol" class="col-md-4 col-form-label text-md-end">Rol</label>
                            <div class="col-md-6">
                                <select name="Rol" id="Rol" class="form-select" required>
                                    <option value="">Seleccione el Rol del Usuario</option>
                                    <option value="Jefe">Jefe de Soporte</option>
                                    <option value="Auxiliar">Auxiliar de Soporte</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                                <div class="invalid-feedback">
                                    El Rol del usuario es requerido.
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <div class="invalid-feedback">
                                    El Correo Electrónico es requerido.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="contrasena" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                <div class="invalid-feedback">
                                    La Contraseña es requerida. Debe contener mínimo 8 caracteres.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" minLength="8" name="contrasena_confirmation" required autocomplete="new-password">
                                <div class="invalid-feedback">
                                    La Confirmación de Contraseña es requerida.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departamentoSelect = document.getElementById('departamento');
            const rolSelect = document.getElementById('Rol');
            const rolHidden = document.getElementById('RolHidden');

            departamentoSelect.addEventListener('change', function () {
                // Si el departamento no es Soporte (asumiendo que el valor 6 es Soporte)
                if (this.value != 6) {
                    rolSelect.value = 'Cliente'; // Cambia el rol a Cliente
                    rolHidden.value = 'Cliente';
                    rolSelect.setAttribute('disabled', true); // Deshabilita el select de Rol
                } else {
                    rolSelect.removeAttribute('disabled'); // Habilita el select de Rol si es Soporte
                    rolHidden.value = rolSelect.value;
                }
            });
            rolSelect.addEventListener('change', function () {
                rolHidden.value = this.value;
            });
        });
    </script>
</div>
@endsection
