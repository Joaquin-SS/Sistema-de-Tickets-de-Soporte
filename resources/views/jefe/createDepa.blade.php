@extends('layouts.appJefe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('mensaje'))
                <div class="alert alert-{{ session('mensaje.tipo') }}">
                    {{ session('mensaje.texto') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Crear Departamento') }}</div>
                <div class="card-body">
                    <form action="{{ url('/departamento') }}" method="POST" class="was-validated">
                        @csrf

                        <div class="form-group row">
                            <label for="departamento" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Departamento') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="departamento" name="departamento" required maxlength="200">
                                <div class="invalid-feedback">
                                    {{ __('El nombre del departamento es requerido.') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="">Seleccione un Estado</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('Debe seleccionar un estado para el departamento.') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Departamento') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

