@extends('layouts.appJefe')

@section('content')
<ul class="nav nav-tabs custom-tab-color" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="ticketEP-tab" data-bs-toggle="tab" data-bs-target="#ticketEP-tab-pane" type="button" role="tab" aria-controls="ticketEP-tab-pane" aria-selected="true">En Proceso</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ticketA-tab" data-bs-toggle="tab" data-bs-target="#ticketA-tab-pane" type="button" role="tab" aria-controls="ticketA-tab-pane" aria-selected="false">Asignados</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ticketC-tab" data-bs-toggle="tab" data-bs-target="#ticketC-tab-pane" type="button" role="tab" aria-controls="ticketC-tab-pane" aria-selected="false">Completados</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ticketNS-tab" data-bs-toggle="tab" data-bs-target="#ticketNS-tab-pane" type="button" role="tab" aria-controls="ticketNS-tab-pane" aria-selected="false">No Solucionados</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ticketCC-tab" data-bs-toggle="tab" data-bs-target="#ticketCC-tab-pane" type="button" role="tab" aria-controls="ticketCC-tab-pane" aria-selected="false">Cancelados</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="ticketEP-tab-pane" role="tabpanel" aria-labelledby="ticketEP-tab" tabindex="0">
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
                    <th>Asignado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketsEP as $ep)
                <tr>
                    <td>{{ $ep->ID_tickets }}</td>
                    <td>{{ $ep->Autor }}</td>
                    <td>{{ $ep->departamento }}</td>
                    <td>{{ $ep->Detalles }}</td>
                    <td>{{ $ep->Clasificacion }}</td>
                    <td>{{ $ep->fecha }}</td>
                    <td><span class="estado en-proceso">{{ $ep->estatus }}</span></td>   
                    <td>
                        <form action="{{ route('asignarAuxiliar', $ep->ID_tickets) }}" method="POST">
                            @csrf
                            <select name="auxiliar_id" class="form-select text-center">
                                <option selected>Seleccione un Auxiliar</option>
                                @foreach($auxiliar as $aux)
                                <option value="{{ $aux->ID_Usuario }}" {{ $ep->auxiliarSoporte == $aux->ID_Usuario ? 'selected' : '' }}>{{ $aux->Nombre }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary mt-1">Asignar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- Fin del tab-pane-->

    <div class="tab-pane fade" id="ticketA-tab-pane" role="tabpanel" aria-labelledby="ticketA-tab" tabindex="0">
        <table class="table text-center table-dark table-striped" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Autor</th>
                    <th>Departamento</th>
                    <th>Detalles</th>
                    <th>Clasificación</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Comentarios</th>
                    <th>Asignado a</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketsA as $ticketA)
                    <tr>
                        <td>{{ $ticketA->ID_tickets }}</td>
                        <td>{{ $ticketA->Autor }}</td>
                        <td>{{ $ticketA->departamento }}</td>
                        <td>{{ $ticketA->Detalles }}</td>
                        <td>{{ $ticketA->Clasificacion }}</td>
                        <td>{{ $ticketA->fecha }}</td>
                        <td><span class="estado asignado">{{ $ticketA->estatus }}</span></td>
                        <td>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#comentModal" data-id="{{ $ticketA->ID_tickets }}">
                                <img src="/images/chat.png" alt="Comentarios">
                            </button>
                        </td>                  
                        <td>
                            <form action="{{ route('asignarAuxiliar', $ticketA->ID_tickets) }}" method="POST">
                                @csrf
                                <select name="auxiliar_id" class="form-select text-center">
                                    @foreach($auxiliar as $aux)
                                        <option value="{{ $aux->ID_Usuario }}" {{ $ticketA->ID_Auxiliar == $aux->ID_Usuario ? 'selected' : '' }}>{{ $aux->Nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-1">Reasignar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- Fin del tab-pane-->

    <div class="tab-pane fade" id="ticketC-tab-pane" role="tabpanel" aria-labelledby="ticketC-tab" tabindex="0">
        <table class="table text-center table-dark table-striped" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Autor</th>
                    <th>Departamento</th>
                    <th>Detalles</th>
                    <th>Clasificación</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Comentarios</th>
                    <th>Asignado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketsC as $ticketC)
                    <tr>
                        <td>{{ $ticketC->ID_tickets }}</td>
                        <td>{{ $ticketC->Autor }}</td>
                        <td>{{ $ticketC->departamento }}</td>
                        <td>{{ $ticketC->Detalles }}</td>
                        <td>{{ $ticketC->Clasificacion }}</td>
                        <td>{{ $ticketC->fecha }}</td>
                        <td><span class="estado completado">{{ $ticketC->estatus }}</span></td>
                        <td>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#comentModal" data-id="{{ $ticketA->ID_tickets }}">
                                <img src="/images/chat.png" alt="Comentarios">
                            </button>
                        </td> 
                        <td>{{ $ticketC->auxiliarSoporte }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- Fin del tab-pane para tickets Completados -->

    <div class="tab-pane fade" id="ticketNS-tab-pane" role="tabpanel" aria-labelledby="ticketNS-tab" tabindex="0">
        <table class="table text-center table-dark table-striped" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Autor</th>
                    <th>Departamento</th>
                    <th>Detalles</th>
                    <th>Clasificación</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Comentarios</th>
                    <th>Asignado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketsNS as $ticketNS)
                    <tr>
                        <td>{{ $ticketNS->ID_tickets }}</td>
                        <td>{{ $ticketNS->Autor }}</td>
                        <td>{{ $ticketNS->departamento }}</td>
                        <td>{{ $ticketNS->Detalles }}</td>
                        <td>{{ $ticketNS->Clasificacion }}</td>
                        <td>{{ $ticketNS->fecha }}</td>
                        <td><span class="estado nosolucionado">{{ $ticketNS->estatus }}</span></td>
                        <td>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#comentModal" data-id="{{ $ticketA->ID_tickets }}">
                                <img src="/images/chat.png" alt="Comentarios">
                            </button>
                        </td> 
                        <td>{{ $ticketNS->auxiliarSoporte }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- Fin del tab-pane -->

    <div class="tab-pane fade" id="ticketCC-tab-pane" role="tabpanel" aria-labelledby="ticketCC-tab" tabindex="0">
        <table class="table text-center table-dark table-striped" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Autor</th>
                    <th>Departamento</th>
                    <th>Detalles</th>
                    <th>Clasificación</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Asignado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticketsCC as $tCC)
                    <tr>
                        <td>{{ $tCC->ID_tickets }}</td>
                        <td>{{ $tCC->Autor }}</td>
                        <td>{{ $tCC->departamento }}</td>
                        <td>{{ $tCC->Detalles }}</td>
                        <td>{{ $tCC->Clasificacion }}</td>
                        <td>{{ $tCC->fecha }}</td>
                        <td><span class="estado cancelado">{{ $tCC->estatus }}</span></td>
                        <td>{{ $tCC->auxiliarSoporte }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--Modal Comentario-->
<div class="modal fade" id="comentModal" tabindex="-1" aria-labelledby="comentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header cardHeaderForm">
                <h5 class="modal-title" id="comentModalLabel">Comentarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: 400px;">
                <ul class="chat-list">
                    
                </ul>
            </div>
            <div class="modal-footer">
                <input type="text" class="form-control custom-input" id="mensajeInput" placeholder="Escribe un mensaje..." required style="flex: 1; margin-right: 10px;">
                <button type="button" class="btn btn-primary" id="enviarMensaje">Enviar</button>
            </div>
        </div>
    </div>
</div>
@endsection