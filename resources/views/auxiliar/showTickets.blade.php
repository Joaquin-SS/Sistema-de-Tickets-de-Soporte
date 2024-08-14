@extends('layouts.appAux')

@section('content')
<div>
    <div class="btn-group">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#filtrarTicketsModal">
        Filtrar Tickets
        </button>
        <button id="clearFiltersBtn" class="btn btn-danger" style="display: none;" onclick="clearFilters()">Quitar filtros</button>

        @if(request()->has('fecha_inicio') && request('fecha_inicio') != '')
            <span class="badge bg-secondary">
                Fecha Inicio: {{ request('fecha_inicio') }}
                <a href="{{ route('ticketAux.index', request()->except('fecha_inicio')) }}" class="close-filter">×</a>
            </span>
        @endif

        @if(request()->has('fecha_fin') && request('fecha_fin') != '')
            <span class="badge bg-secondary">
                Fecha Fin: {{ request('fecha_fin') }}
                <a href="{{ route('ticketAux.index', request()->except('fecha_fin')) }}" class="close-filter">×</a>
            </span>
        @endif

        @if(request()->has('departamento') && !empty(request('departamento')))
            @foreach(request('departamento') as $departamento)
                <span class="badge bg-secondary">
                    Departamento: {{ $departamento }}
                    <a href="{{ route('ticketAux.index', array_merge(request()->except('departamento'), ['departamento' => array_diff(request('departamento'), [$departamento])])) }}" class="close-filter">×</a>
                </span>
            @endforeach
        @endif

        @if(request()->has('estatus') && !empty(request('estatus')))
            @foreach(request('estatus') as $estatus)
                <span class="badge bg-secondary">
                    Estatus: {{ $estatus }}
                    <a href="{{ route('ticketAux.index', array_merge(request()->except('estatus'), ['estatus' => array_diff(request('estatus'), [$estatus])])) }}" class="close-filter">×</a>
                </span>
            @endforeach
        @endif
    </div>

    <table class="table text-center table-dark table-striped" border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Autor</th>
                <th>Departamento</th>
                <th>Detalles</th>
                <th>Clasificacion</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Auxiliar</th>
                <th>Comentarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->ID_tickets }}</td>
                <td>{{ $ticket->Autor }}</td>
                <td>{{ $ticket->departamento }}</td>
                <td>{{ $ticket->Detalles }}</td>
                <td>{{ $ticket->Clasificacion }}</td>
                <td>{{ $ticket->fecha }}</td>
                <td class="estatus-container">
                    <span class="estado
                        @switch($ticket->estatus)
                            @case('Asignado')
                                asignado
                                @break
                            @case('Completado')
                                completado
                                @break
                            @case('No Solucionado')
                                nosolucionado
                                @break
                            @case('En Proceso')
                                en-proceso
                                @break
                            @case('Cancelado')
                                cancelado
                                @break
                        @endswitch
                    ">{{ $ticket->estatus }}</span>
                    @if(!in_array($ticket->estatus, ['Cancelado', 'En Proceso']))
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#cambiarEstatusModal" data-ticket-id="{{ $ticket->ID_tickets }}" data-ticket-estatus="{{ $ticket->estatus }}">
                            <img src="/images/intercambio.png" alt="Cambiar">
                        </button>
                    @endif
                </td>
                <td>{{ $ticket->auxiliarSoporte }}</td>
                <td>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#comentClienteModal" data-id="{{ $ticket->ID_tickets }}">
                        <img src="/images/chatCliente.png" alt="ComentariosCliente">
                    </button>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#comentJefeModal" data-id="{{ $ticket->ID_tickets }}">
                        <img src="/images/chatJefe.png" alt="ComentariosJefe">
                    </button>
                </td>        
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Links de paginación -->
    {{ $tickets->appends(request()->except('page'))->links('pagination::bootstrap-4') }}</div>

<!--Modal de filtros-->
<div class="modal fade" id="filtrarTicketsModal" tabindex="-1" aria-labelledby="filtrarTicketsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm text-center">
                <h5 class="modal-title" id="filtrarTicketsModalLabel">Filtrar Tickets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ticketAux.index') }}" method="GET" onsubmit="showSpinners()">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio">
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin">
                    </div>

                    <div class="form-group">
                        <label>Departamento:</label>
                        <div>
                            <label><input type="checkbox" name="departamento[]" value="Compras"> Compras</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="departamento[]" value="Contabilidad"> Contabilidad</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="departamento[]" value="Logística"> Logística</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="departamento[]" value="Producción"> Producción</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="departamento[]" value="Ventas"> Ventas</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="departamento[]" value="Soporte"> Soporte</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Estatus:</label>
                        <div>
                            <label><input type="checkbox" name="estatus[]" value="En Proceso"> En Proceso</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="estatus[]" value="Asignado"> Asignado</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="estatus[]" value="Completado"> Completado</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="estatus[]" value="No Solucionado"> No Solucionado</label>
                        </div>
                        <div>
                            <label><input type="checkbox" name="estatus[]" value="Cancelado"> Cancelado</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aplicar Filtro</button>
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
        </div>
    </div>
</div>

<!-- Modal cambio d Estatus -->
<div class="modal fade" id="cambiarEstatusModal" tabindex="-1" aria-labelledby="cambiarEstatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm text-center">
                <h5 class="modal-title" id="cambiarEstatusModalLabel">Cambiar Estatus del Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCambiarEstatus" action="{{ route('ticketAux.actualizarEstatus', ['ID_tickets' => 'temp']) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="ticketId" name="ticketId">
                    <div class="mb-3">
                        <label for="nuevoEstatus" class="form-label">Nuevo Estatus:</label>
                        <select class="form-select" id="nuevoEstatus" name="nuevoEstatus">
                            <option value="Asignado">No Completado</option>
                            <option value="Completado">Completado</option>
                            <option value="No Solucionado">No Solucionado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para comentarios con el Jefe -->
<div class="modal fade" id="comentJefeModal" tabindex="-1" aria-labelledby="comentJefeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm">
                <h5 class="modal-title" id="comentJefeModalLabel">Comentarios con el Jefe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: 400px;">
                <ul class="chat-list-jefe"></ul>
            </div>
            <div class="modal-footer">
                <input type="text" class="form-control custom-input" id="mensajeInputJefe" placeholder="Escribe un mensaje..." required style="flex: 1; margin-right: 10px;">
                <button type="button" class="btn btn-primary" id="enviarMensajeJefe">Enviar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para comentarios con el Cliente -->
<div class="modal fade" id="comentClienteModal" tabindex="-1" aria-labelledby="comentClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm">
                <h5 class="modal-title" id="comentClienteModalLabel">Comentarios con el Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: 400px;">
                <ul class="chat-list-cliente"></ul>
            </div>
            <div class="modal-footer">
                <input type="text" class="form-control custom-input" id="mensajeInputCliente" placeholder="Escribe un mensaje..." required style="flex: 1; margin-right: 10px;">
                <button type="button" class="btn btn-primary" id="enviarMensajeCliente">Enviar</button>
            </div>
        </div>
    </div>
</div>


@if(request()->query('fecha_inicio') || request()->query('fecha_fin') || request()->query('departamento') || request()->query('estatus'))
<script>
    function clearFilters() {
        window.location.href = window.location.pathname;
        setTimeout(function() {
            showSpinners();
        }, 100);
    }

      document.addEventListener('DOMContentLoaded', (event) => {
       document.getElementById('clearFiltersBtn').style.display = 'block';
      });
</script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cambiarEstatusModal = document.getElementById('cambiarEstatusModal');
        cambiarEstatusModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ticketId = button.getAttribute('data-ticket-id');
            var ticketEstatus = button.getAttribute('data-ticket-estatus');

            var formCambiarEstatus = document.getElementById('formCambiarEstatus');
            var actionUrl = formCambiarEstatus.getAttribute('action');
            formCambiarEstatus.setAttribute('action', actionUrl.replace('temp', ticketId));

            var modalNuevoEstatus = cambiarEstatusModal.querySelector('#nuevoEstatus');
            
            modalNuevoEstatus.value = ticketEstatus;
        });
    });

</script>

@endsection