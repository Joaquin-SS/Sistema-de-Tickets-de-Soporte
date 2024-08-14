@extends('layouts.appJefe')

@section('content')
<form action="{{ route('ticketJefe.store') }}" method="post" enctype="multipart/form-data" onsubmit="showSpinners()">
    {{ csrf_field() }}

    <select name="Clasificacion" id="Clasificacion"  class="form-select" aria-label="Disabled select example" required>
        <option selected>Seleccione una Clasificación del Problema</option>
        <option value="Falla de Office">Falla de Office</option>
        <option value="Fallas en la Red">Fallas en la Red</option>
        <option value="Errores de software">Errores de software</option>
        <option value="Errores de Hardware">Errores de Hardware</option>
        <option value="Mantenimientos Preventivos">Mantenimientos Preventivos</option>
        <option value="Otro">Otro</option>
    </select>

    <label for="Detalles">Detalles</label>
    <textarea class="form-control" name="Detalles" id="Detalles" required></textarea>

    <input type="submit" value="Agregar">
</form>
@endsection