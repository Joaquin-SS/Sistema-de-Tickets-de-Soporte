@extends('layouts.appJefe')

@section('content')
<h3 class="mb-3"><b>Usuarios de la Empresa</b></h3>
<ul class="nav nav-tabs custom-tab-color" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras-tab-pane" type="button" role="tab" aria-controls="compras-tab-pane" aria-selected="true">Compras</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contabilidad-tab" data-bs-toggle="tab" data-bs-target="#contabilidad-tab-pane" type="button" role="tab" aria-controls="contabilidad-tab-pane" aria-selected="false">Contabilidad</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="logistica-tab" data-bs-toggle="tab" data-bs-target="#logistica-tab-pane" type="button" role="tab" aria-controls="logistica-tab-pane" aria-selected="false">Logística</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="produccion-tab" data-bs-toggle="tab" data-bs-target="#produccion-tab-pane" type="button" role="tab" aria-controls="produccion-tab-pane" aria-selected="false">Producción</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ventas-tab" data-bs-toggle="tab" data-bs-target="#ventas-tab-pane" type="button" role="tab" aria-controls="ventas-tab-pane" aria-selected="false">Ventas</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="soporte-tab" data-bs-toggle="tab" data-bs-target="#soporte-tab-pane" type="button" role="tab" aria-controls="soporte-tab-pane" aria-selected="false">Soporte</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <!-- Panel de compras -->
    <div class="tab-pane fade show active" id="compras-tab-pane" role="tabpanel" aria-labelledby="compras-tab" tabindex="0">
        <div class="row"> <!-- Inicia el row para el sistema de grid -->
            @foreach($usuariosCompras as $user1)
                <div class="col-sm-6 col-md-3 mb-3"> <!-- Establecer que la card ocupa 3 columnas en md y 6 en sm -->
                    <div class="card cardUsers">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/images/usuario.png" class="img-fluid rounded-start" alt="...">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Boton Modal Editar -->
                                    <button type="button" class="btn editarUsuario" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"
                                        data-id="{{ $user1->ID_Usuario }}"
                                        data-nombre="{{ $user1->Nombre }}"
                                        data-email="{{ $user1->email }}"
                                        data-departamento=1
                                        data-rol="{{ $user1->Rol }}">
                                        <img src="/images/editar.png" alt="Editar">
                                    </button>
                                    <!-- Boton Modal Eliminar -->
                                    <button type="button" class="btn triggerEliminarUsuario" data-bs-toggle="modal" data-bs-target="#confirmarEliminacionModal" data-id="{{ $user1->ID_Usuario }}" data-nombre="{{ $user1->Nombre }}">
                                            <img src="/images/eliminar.png" alt="Eliminar">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><b>{{ 'No.Empleado: ' . $user1->ID_Usuario }}</b></h4>
                                    <h5 class="card-text"><b>{{ $user1->Nombre }}</b></h5>
                                    <h5 class="card-text">{{ $user1->email }}</h5>
                                    <h5 class="card-text">{{ $user1->departamento }}</h5>
                                    <h5 class="card-text"><small class="text-body-secondary"><b>{{ $user1->Rol }}</b></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div><!-- Fin del tab-pane compras-->

    <!-- Tab-pane Contabilidad-->
    <div class="tab-pane fade" id="contabilidad-tab-pane" role="tabpanel" aria-labelledby="contabilidad-tab" tabindex="0">
    <div class="row"> <!-- Inicia el row para el sistema de grid -->
            @foreach($usuariosContabilidad as $user2)
                <div class="col-sm-6 col-md-3 mb-3"> <!-- Establecer que la card ocupa 3 columnas en md y 6 en sm -->
                    <div class="card cardUsers">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/images/usuario.png" class="img-fluid rounded-start" alt="...">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Boton Modal Editar -->
                                    <button type="button" class="btn editarUsuario" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"
                                        data-id="{{ $user2->ID_Usuario }}"
                                        data-nombre="{{ $user2->Nombre }}"
                                        data-email="{{ $user2->email }}"
                                        data-departamento=2
                                        data-rol="{{ $user2->Rol }}">
                                        <img src="/images/editar.png" alt="Editar">
                                    </button>
                                    <!-- Boton Modal Eliminar -->
                                    <button type="button" class="btn triggerEliminarUsuario" data-bs-toggle="modal" data-bs-target="#confirmarEliminacionModal" data-id="{{ $user2->ID_Usuario }}" data-nombre="{{ $user2->Nombre }}">
                                            <img src="/images/eliminar.png" alt="Eliminar">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><b>{{ 'No.Empleado: ' . $user2->ID_Usuario }}</b></h4>
                                    <h5 class="card-text"><b>{{ $user2->Nombre }}</b></h5>
                                    <h5 class="card-text">{{ $user2->email }}</h5>
                                    <h5 class="card-text">{{ $user2->departamento }}</h5>
                                    <h5 class="card-text"><small class="text-body-secondary"><b>{{ $user2->Rol }}</b></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> <!-- Fin del tab-pane Contabilidad-->

    <!-- Tab-pane Logistica-->
    <div class="tab-pane fade" id="logistica-tab-pane" role="tabpanel" aria-labelledby="logistica-tab" tabindex="0">
    <div class="row"> <!-- Inicia el row para el sistema de grid -->
            @foreach($usuariosLogistica as $user3)
                <div class="col-sm-6 col-md-3 mb-3"> <!-- Establecer que la card ocupa 3 columnas en md y 6 en sm -->
                    <div class="card cardUsers">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/images/usuario.png" class="img-fluid rounded-start" alt="...">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Boton Modal Editar -->
                                    <button type="button" class="btn editarUsuario" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"
                                        data-id="{{ $user3->ID_Usuario }}"
                                        data-nombre="{{ $user3->Nombre }}"
                                        data-email="{{ $user3->email }}"
                                        data-departamento=3
                                        data-rol="{{ $user3->Rol }}">
                                        <img src="/images/editar.png" alt="Editar">
                                    </button>
                                    <!-- Boton Modal Eliminar -->
                                    <button type="button" class="btn triggerEliminarUsuario" data-bs-toggle="modal" data-bs-target="#confirmarEliminacionModal" data-id="{{ $user3->ID_Usuario }}" data-nombre="{{ $user3->Nombre }}">
                                            <img src="/images/eliminar.png" alt="Eliminar">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><b>{{ 'No.Empleado: ' . $user3->ID_Usuario }}</b></h4>
                                    <h5 class="card-text"><b>{{ $user3->Nombre }}</b></h5>
                                    <h5 class="card-text">{{ $user3->email }}</h5>
                                    <h5 class="card-text">{{ $user3->departamento }}</h5>
                                    <h5 class="card-text"><small class="text-body-secondary"><b>{{ $user3->Rol }}</b></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div><!-- Fin del Tab-pane Logistica-->
    
    <!-- Tab-pane Produccion-->
    <div class="tab-pane fade" id="produccion-tab-pane" role="tabpanel" aria-labelledby="produccion-tab" tabindex="0">
    <div class="row"> <!-- Inicia el row para el sistema de grid -->
            @foreach($usuariosProduccion as $user4)
                <div class="col-sm-6 col-md-3 mb-3"> <!-- Establecer que la card ocupa 3 columnas en md y 6 en sm -->
                    <div class="card cardUsers">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/images/usuario.png" class="img-fluid rounded-start" alt="...">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Boton Modal Editar -->
                                    <button type="button" class="btn editarUsuario" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"
                                        data-id="{{ $user4->ID_Usuario }}"
                                        data-nombre="{{ $user4->Nombre }}"
                                        data-email="{{ $user4->email }}"
                                        data-departamento=4
                                        data-rol="{{ $user4->Rol }}">
                                        <img src="/images/editar.png" alt="Editar">
                                    </button>
                                    <!-- Boton Modal Eliminar -->
                                    <button type="button" class="btn triggerEliminarUsuario" data-bs-toggle="modal" data-bs-target="#confirmarEliminacionModal" data-id="{{ $user4->ID_Usuario }}" data-nombre="{{ $user4->Nombre }}">
                                            <img src="/images/eliminar.png" alt="Eliminar">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><b>{{ 'No.Empleado: ' . $user4->ID_Usuario }}</b></h4>
                                    <h5 class="card-text"><b>{{ $user4->Nombre }}</b></h5>
                                    <h5 class="card-text">{{ $user4->email }}</h5>
                                    <h5 class="card-text">{{ $user4->departamento }}</h5>
                                    <h5 class="card-text"><small class="text-body-secondary"><b>{{ $user4->Rol }}</b></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div><!-- Fin del Tab-pane Produccion-->

    <!-- Tab-pane Ventas-->
    <div class="tab-pane fade" id="ventas-tab-pane" role="tabpanel" aria-labelledby="ventas-tab" tabindex="0">
    <div class="row"> <!-- Inicia el row para el sistema de grid -->
            @foreach($usuariosVentas as $user5)
                <div class="col-sm-6 col-md-3 mb-3"> <!-- Establecer que la card ocupa 3 columnas en md y 6 en sm -->
                    <div class="card cardUsers">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/images/usuario.png" class="img-fluid rounded-start" alt="...">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Boton Modal Editar -->
                                    <button type="button" class="btn editarUsuario" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"
                                        data-id="{{ $user5->ID_Usuario }}"
                                        data-nombre="{{ $user5->Nombre }}"
                                        data-email="{{ $user5->email }}"
                                        data-departamento=5
                                        data-rol="{{ $user5->Rol }}">
                                        <img src="/images/editar.png" alt="Editar">
                                    </button>
                                    <!-- Boton Modal Eliminar -->
                                    <button type="button" class="btn triggerEliminarUsuario" data-bs-toggle="modal" data-bs-target="#confirmarEliminacionModal" data-id="{{ $user5->ID_Usuario }}" data-nombre="{{ $user5->Nombre }}">
                                            <img src="/images/eliminar.png" alt="Eliminar">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><b>{{ 'No.Empleado: ' . $user5->ID_Usuario }}</b></h4>
                                    <h5 class="card-text"><b>{{ $user5->Nombre }}</b></h5>
                                    <h5 class="card-text">{{ $user5->email }}</h5>
                                    <h5 class="card-text">{{ $user5->departamento }}</h5>
                                    <h5 class="card-text"><small class="text-body-secondary"><b>{{ $user5->Rol }}</b></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> <!-- Fin Tab-pane Ventas -->

    <!-- Tab-pane Soporte-->
    <div class="tab-pane fade" id="soporte-tab-pane" role="tabpanel" aria-labelledby="soporte-tab" tabindex="0">
    <div class="row"> <!-- Inicia el row para el sistema de grid -->
            @foreach($usuariosSoporte as $user6)
                <div class="col-sm-6 col-md-3 mb-3"> <!-- Establecer que la card ocupa 3 columnas en md y 6 en sm -->
                    <div class="card cardUsers">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/images/usuario.png" class="img-fluid rounded-start" alt="...">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Boton Modal Editar -->
                                    <button type="button" class="btn editarUsuario" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"
                                        data-id="{{ $user6->ID_Usuario }}"
                                        data-nombre="{{ $user6->Nombre }}"
                                        data-email="{{ $user6->email }}"
                                        data-departamento=6
                                        data-rol="{{ $user6->Rol }}">
                                        <img src="/images/editar.png" alt="Editar">
                                    </button>
                                    <!-- Boton Modal Eliminar -->
                                    <button type="button" class="btn triggerEliminarUsuario" data-bs-toggle="modal" data-bs-target="#confirmarEliminacionModal" data-id="{{ $user6->ID_Usuario }}" data-nombre="{{ $user6->Nombre }}">
                                            <img src="/images/eliminar.png" alt="Eliminar">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><b>{{ 'No.Empleado: ' . $user6->ID_Usuario }}</b></h4>
                                    <h5 class="card-text"><b>{{ $user6->Nombre }}</b></h5>
                                    <h5 class="card-text">{{ $user6->email }}</h5>
                                    <h5 class="card-text">{{ $user6->departamento }}</h5>
                                    <h5 class="card-text"><small class="text-body-secondary"><b>{{ $user6->Rol }}</b></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> <!-- Fin Tab-pane Soporte-->
</div>

<!--Modal Editar-->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm text-center">
                <h1 class="modal-title fs-5 text-center" id="editarUsuarioModalLabel"><b>Editar Usuario</b></h1>
                <button type="button" class="btn-close custom-close-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm" method="post" class="was-validated" enctype="multipart/form-data" onsubmit="showSpinners()">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                        
                    <!-- Nombre -->
                    <div class="row mb-3">
                        <label for="Nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre Completo') }}</label>
                        <div class="col-md-6">
                            <input id="Nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="Nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                <option selected>Seleccione el Departamento del Usuario</option>
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
                    <div class="row mb-3">
                        <label for="Rol" class="col-md-4 col-form-label text-md-end">Rol</label>
                        <div class="col-md-6">
                            <select name="Rol" id="Rol" class="form-control" required>
                                <option selected>Seleccione el Rol del Usuario</option>
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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <div class="invalid-feedback">
                                    El Correo Electrónico es requerido.
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
<div class="modal fade" id="confirmarEliminacionModal" tabindex="-1" aria-labelledby="confirmarEliminacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm">
                <h5 class="modal-title" id="confirmarEliminacionModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close custom-close-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="textoConfirmacion">¿Seguro que deseas eliminar a <strong id="nombreUsuario">Nombre de Usuario </strong>?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminarUsuario" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //SCRIPT EDITAR
    // Preparar el DOM
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener todos los botones de editar
        const editarUsuarioBtns = document.querySelectorAll('.editarUsuario');
        
        // Asignar un evento click a cada boton
        editarUsuarioBtns.forEach(btn => {
            btn.addEventListener('click', function() {
            // Aquí obtienes los datos del usuario desde los atributos data-*
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const email = this.getAttribute('data-email');
            const departamento = this.getAttribute('data-departamento');
            const rol = this.getAttribute('data-rol');
            
            //Establecer la accion del formulario
            document.getElementById('editarUsuarioForm').action = `/user/${id}`;

            // Llenar los campos del modal con los datos
            document.getElementById('Nombre').value = nombre;
            document.getElementById('email').value = email;
            document.getElementById('departamento').value = departamento;
            document.getElementById('Rol').value = rol;

            actualizarEstadoRol();

            var myModal = new bootstrap.Modal(document.getElementById('editarUsuarioModal'));
            myModal.show();
            });
        });

        // Para eliminar
        document.querySelectorAll('.triggerEliminarUsuario').forEach(item => {
            item.addEventListener('click', event => {
                const userId = item.getAttribute('data-id');
                const userName = item.getAttribute('data-nombre');
                
                // Configura la acción del formulario con el ID del usuario
                document.getElementById('formEliminarUsuario').action = `/user/${userId}`;
                
                // Actualiza el texto de confirmación con el nombre del usuario
                document.getElementById('nombreUsuario').textContent = userName;
                
                // Muestra el modal
                var myModal = new bootstrap.Modal(document.getElementById('confirmarEliminacionModal'));
                myModal.show();
            });
        });

        //Manejo del Select Rol de usuarios        
        function actualizarEstadoRol() {
            const departamentoSelect = document.getElementById('departamento');
            const rolSelect = document.getElementById('Rol');
            if (departamentoSelect.value != '6') {
                rolSelect.value = 'Cliente'; 
                rolSelect.setAttribute('disabled', true); 
            } else {
                rolSelect.removeAttribute('disabled'); 
            }
        }
        const departamentoSelect = document.getElementById('departamento');
        departamentoSelect.addEventListener('change', actualizarEstadoRol);
    });    
</script>
@endsection