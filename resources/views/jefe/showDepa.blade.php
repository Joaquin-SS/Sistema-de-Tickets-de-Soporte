@extends('layouts.appJefe')

@section('content')
<table class="table text-center table-dark table-striped" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Departamento</th>
            <th>Estatus</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departamentos as $dep)
        <tr>
            <td>{{ $dep->iddepartamentos }}</td>
            <td>{{ $dep->departamento }}</td>
            <td>{{ $dep->estado }}</td>
            <td>
                <button type="button" class="btn editarDepa" data-bs-toggle="modal" data-bs-target="#editarDepaModal"
                    data-id="{{ $dep->iddepartamentos }}"
                    data-nombre="{{ $dep->departamento }}"
                    data-estado="{{ $dep->estado }}">
                    <img src="/images/editar.png" alt="Editar">
                </button>
            </td>    
            <td>
                <button type="button" class="btn triggerEliminarDepa" data-bs-toggle="modal" data-bs-target="#confirmarEliminaModal" data-id="{{ $dep->iddepartamentos }}" data-nombre="{{ $dep->departamento }}">
                        <img src="/images/eliminar.png" alt="Eliminar">
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!--Modal Editar-->
<div class="modal fade" id="editarDepaModal" tabindex="-1" aria-labelledby="editarDepaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm text-center">
                <h1 class="modal-title fs-5 text-center" id="editarDepaModalLabel"><b>Editar Departamento</b></h1>
                <button type="button" class="btn-close custom-close-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarDepaForm" method="post" class="was-validated" enctype="multipart/form-data" onsubmit="showSpinners()">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                        
                    <!-- Nombre -->
                    <div class="row mb-3">
                        <label for="Departamento" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del Departamento') }}</label>
                        <div class="col-md-6">
                            <input id="Departamento" type="text" class="form-control @error('name') is-invalid @enderror" name="Departamento" value="{{ old('depa') }}" required autocomplete="depa" autofocus>
                            <div class="invalid-feedback">
                                    El Nombre del Departamento es requerido.
                            </div>
                        </div>
                    </div>
                    <!-- Estado -->
                    <div class="row mb-3">
                        <label for="estado" class="col-md-4 col-form-label text-md-end">Estado</label>
                        <div class="col-md-6">
                            <select name="estado" id="estado" class="form-select" required>
                                <option selected>Seleccione el estado del Departamento</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                            <div class="invalid-feedback">
                                    El Estado del Departamento es requerido.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-warning">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div id="spinnerContainer" style="display: none;" class="text-center">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <script>
                    function showSpinners() {
                        document.getElementById('spinnerContainer').style.display = 'block';
                    }
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div> <!-- Fin del Modal  Editar-->

<!--Modal Eliminar-->
<div class="modal fade" id="confirmarEliminaModal" tabindex="-1" aria-labelledby="confirmarEliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm">
                <h5 class="modal-title" id="confirmarEliminaModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close custom-close-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="textoConfirmacion">¿Seguro que deseas eliminar el departamento de <strong id="nombreDepartamento">Departamento </strong>?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminarDepa" action="" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //SCRIPT EDITAR
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener todos los botones de editar
        const editarDepaBtns = document.querySelectorAll('.editarDepa');
        
        // Asignar un evento click a cada boton
        editarDepaBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Obtienes los datos del departamento desde los atributos data-*
                const id = this.getAttribute('data-id');
                const nombre = this.getAttribute('data-nombre');
                const estado = this.getAttribute('data-estado');
                
                // Establecer la acción del formulario
                document.getElementById('editarDepaForm').action = `/departamento/${id}`;

                // Llenar los campos del modal con los datos
                document.getElementById('Departamento').value = nombre;
                document.getElementById('estado').value = estado;

                var myModal = new bootstrap.Modal(document.getElementById('editarDepaModal'));
                myModal.show();
            });
        });

        // Para eliminar
        const eliminarDepaBtns = document.querySelectorAll('.triggerEliminarDepa');
        eliminarDepaBtns.forEach(item => {
            item.addEventListener('click', event => {
                const depaId = item.getAttribute('data-id');
                const depaName = item.getAttribute('data-nombre');
                
                // Configura la acción del formulario con el ID del departamento
                document.getElementById('formEliminarDepa').action = `/departamento/${depaId}`;                
                // Actualiza el texto de confirmación con el nombre del Departamento
                document.getElementById('nombreDepartamento').textContent = depaName;
                
                // Muestra el modal
                var myModal = new bootstrap.Modal(document.getElementById('confirmarEliminaModal'));
                myModal.show();
            });
        });
    });
</script>

@endsection
