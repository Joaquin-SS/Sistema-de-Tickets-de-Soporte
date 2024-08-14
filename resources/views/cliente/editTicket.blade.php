@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Actualizar Ticket') }}</div>
                <div class="card-body">
                    <form action="{{ url('/ticketCliente/' . $ticket->ID_tickets) }}" method="post" class="was-validated">
                        @csrf
                        @method('PUT') <!-- Importante para la actualización -->

                        <!-- Mostrar la información NO EDITABLE -->
                        <div class="row mb-3">
                            <div class="col text-center">
                                <label><b>ID Ticket:</b> {{ $ticket->ID_tickets }}</label>
                            </div>
                            <div class="col text-center">
                                <label><b>Auxiliar de Soporte: </b> {{ $ticket->auxiliar_Soporte ?? 'No asignado' }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col text-center">
                                <label><b>Fecha: </b> {{ $ticket->fecha }}</label>
                            </div>
                            <div class="col text-center">
                                <label><b>Estatus: </b><span class="estado en-proceso">{{ $ticket->estatus }}</span></label>
                            </div>
                        </div>

                        <!-- Mostrar la información EDITABLE -->
                        <div class="mb-3">
                            <label for="Clasificacion" class="form-label">{{ __('Clasificación del Problema') }}</label>
                            <select name="Clasificacion" id="Clasificacion" class="form-select" required>
                                <option value="Falla de Office" {{ $ticket->Clasificacion == "Falla de Office" ? 'selected' : '' }}>Falla de Office</option>
                                <option value="Fallas en la Red" {{ $ticket->Clasificacion == "Fallas en la Red" ? 'selected' : '' }}>Fallas en la Red</option>
                                <option value="Errores de software" {{ $ticket->Clasificacion == "Errores de software" ? 'selected' : '' }}>Errores de software</option>
                                <option value="Errores de Hardware" {{ $ticket->Clasificacion == "Errores de Hardware" ? 'selected' : '' }}>Errores de Hardware</option>
                                <option value="Mantenimientos Preventivos" {{ $ticket->Clasificacion == "Mantenimientos Preventivos" ? 'selected' : '' }}>Mantenimientos Preventivos</option>
                                <option value="Otro" {{ $ticket->Clasificacion == "Otro" ? 'selected' : '' }}>Otro</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione una clasificación para el problema.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Detalles" class="form-label">{{ __('Detalles') }}</label>
                            <textarea class="form-control" name="Detalles" id="Detalles" required>{{ $ticket->Detalles }}</textarea>
                            <div class="invalid-feedback">
                                Proporcione una descripción detallada del problema.
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
