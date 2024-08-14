@extends('layouts.appAux')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<!-- Card del perfil -->
<div class="cardPerfil card">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ Auth::user()->fotoPerfil }}" class="img-fluid rounded-circle" alt="Foto de perfil" style="object-fit: cover; width: 240px; height: 240px; border-radius: 50%;">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><b>Bienvenido(a)</b></h1>
        <h2 class="card-title"> {{ Auth::user()->Nombre }} </h2>
        <p class="card-text"> {{ Auth::user()->email }} </p>
        <p class="card-text text-body-secondary"> {{ Auth::user()->Rol }} </p>
      </div>
    </div>
  </div>
</div>

<!-- Card de fecha y hora -->
<div class="card cardFecha">
  <div class="card-body">
    <h3 class="card-title"><b>Fecha y Hora</b></h3>
    <p class="card-text" id="currentDateTime"></p>
  </div>
</div>

<!-- Script para obtener la fecha y hora en tiempo real -->
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    function updateDateTime() {
      const now = new Date();
      //Formato para la fecha
      const options = {
        weekday: 'long', 
        year: 'numeric',
        month: 'long', 
        day: 'numeric',
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
      };
      //Genera la cadena con la fecha y hora
      const formattedDateTime = now.toLocaleString('es-ES', options);
      document.getElementById('currentDateTime').textContent = formattedDateTime;
    }

    //Esto actualiza la fecha y hora cada segundo
    setInterval(updateDateTime, 1000);

    updateDateTime();
  });
</script>

<div class="card cardDash">
  <div class="card-header">
    <h3><b>Dashboard</b></h3>
  </div>
  <div class="card-body d-flex flex-wrap">

    <div class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center">
          <img src="{{ asset('images/ticketAsignado.png') }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title">Tickets Asignados</h4>
            <p class="card-text"><b>{{ $ticketsAsignados }}</b></p>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center">
          <img src="{{ asset('images/ticketFinalizado.png') }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title">Tickets Finalizados</h4>
            <p class="card-text"><b>{{ $ticketsFinalizados }}</b></p>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center">
          <img src="{{ asset('images/ticketNS.png') }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title">Tickets No Solucionados</h4>
            <p class="card-text"><b>{{ $ticketsNS }}</b></p>
          </div>
        </div>
      </div>
    </div>

    <!-- CORREGIR REPORTES PARA AUXILIAR -->
    <div href="{{ route('imprimirTicketsFecha') }}" class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center">
        </div>
        <form action="{{ route('imprimirTicketsFecha') }}" method="POST" class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      @csrf
      <div class="row g-0">
          <div class="col-md-4 d-flex justify-content-center">
              <img style="height: 80px; width: 80px" src="{{ asset('images/ticketImprimir.png') }}" class="img-fluid rounded-start " alt="...">
          </div>
          <div class="col-md-8">
              <div class="card-body">
                  <h4 class="card-title">Imprimir ticket por fecha</h4>
              </div>
              <input type="date" name="fechaInicio">
              <input type="date" name="fechaFin">
  
              <input type="submit" value="Imprimir">
          </div>
      </div>
    </form>
      </div>
</div>
    <a href="{{ route('imprimirTicketsAuxiliar') }}" class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center">
          <img style="height: 80px; width: 80px" src="{{ asset('images/ticketImprimir.png') }}" class="img-fluid rounded-start " alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title">Imprimir ticket por Auxiliar</h4>
          </div>
        </div>
      </div>
    </a>
    <a href="{{ route('imprimirTicketsEstatus') }}" class="card mb-3 me-2 cardElement" style="max-width: 220px; flex-grow:1;">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center">
          <img style="height: 80px; width: 80px" src="{{ asset('images/ticketImprimir.png') }}" class="img-fluid rounded-start " alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title">Imprimir ticket por Estatus</h4>
          </div>
        </div>
      </div>
    </a>
      </div>
    </form>
  

  </div>
</div>
@endsection