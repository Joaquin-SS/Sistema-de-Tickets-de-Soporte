@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Perfil') }}</div>

                <div class="card-body">
                    <!-- Sección de cambio de foto de perfil -->
                    <div>
                        <h4>{{ __('Cambiar Foto de Perfil') }}</h4>
                        <!-- Mostrar la imagen actual -->
                        <div class="text-center mb-3">
                            <img src="{{ Auth::user()->fotoPerfil }}" class="img-thumbnail" style="width: 140px; height: 140px; object-fit: cover;">
                        </div>
                        <form method="POST" action="{{ route('updatePhoto') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="profilePhoto" name="profilePhoto" required>
                                <small class="form-text text-muted">{{ __('Elige una foto de perfil.') }}</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Actualizar Foto') }}</button>
                            </div>
                        </form>
                    </div>

                    <hr>

                    <!-- Formulario de cambio de contraseña -->
                    <div>
                        <h4>{{ __('Cambiar Contraseña') }}</h4>
                        <form method="POST" class="was-validated" action="{{ route('cambiarContra') }}">
                            @csrf

                            <!-- Contraseña actual -->
                            <div class="form-group row">
                                <label for="contraActual" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Actual') }}</label>
                                <div class="col-md-6">
                                    <input id="contraActual" type="password" class="form-control" minLength="8" name="contraActual" required>
                                    <div class="invalid-feedback">
                                        {{ __('La Contraseña actual es requerida.') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Nueva contraseña -->
                            <div class="form-group row">
                                <label for="nuevaContra" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>
                                <div class="col-md-6">
                                    <input id="nuevaContra" type="password" class="form-control" minLength="8" name="nuevaContra" required>
                                    <div class="invalid-feedback">
                                        {{ __('La Nueva Contraseña es requerida. Debe contener mínimo 8 caracteres.') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Confirmar la nueva contraseña -->
                            <div class="form-group row">
                                <label for="nuevaContra_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar nueva contraseña') }}</label>
                                <div class="col-md-6">
                                    <input id="nuevaContra_confirmation" type="password" class="form-control" minLength="8" name="nuevaContra_confirmation" required>
                                    <div class="invalid-feedback">
                                        {{ __('La Confirmación de Contraseña es requerida.') }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cambiar Contraseña') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
