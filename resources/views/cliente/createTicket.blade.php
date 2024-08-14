@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Ticket') }}</div>
                <div class="card-body">
                    <form action="{{ route('ticketCliente.store') }}" method="post" enctype="multipart/form-data" class="was-validated" onsubmit="showSpinners()">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="Clasificacion" class="form-label">{{ __('Clasificación del Problema') }}</label>
                            <select name="Clasificacion" id="Clasificacion" class="form-select" required>
                                <option value="" selected disabled>Seleccione una Clasificación del Problema</option>
                                <option value="Falla de Office">Falla de Office</option>
                                <option value="Fallas en la Red">Fallas en la Red</option>
                                <option value="Errores de software">Errores de software</option>
                                <option value="Errores de Hardware">Errores de Hardware</option>
                                <option value="Mantenimientos Preventivos">Mantenimientos Preventivos</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione una clasificación para el problema.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Detalles" class="form-label">{{ __('Detalles') }}</label>
                            <textarea class="form-control" name="Detalles" id="Detalles" required></textarea>
                            <div class="invalid-feedback">
                                Proporcione una descripción detallada del problema.
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="{{ __('Agregar Ticket') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
