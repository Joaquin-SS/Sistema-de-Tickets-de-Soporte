<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1> {{$idAuxiliar}} </h1>
    @foreach ($tickets->groupBy('departamento') as $departamento => $ticketsPorDepartamento)
        <h2>{{ $departamento }}</h2>
        <table>
            <thead>
                <tr>
                    <th>No. Ticket</th>
                    <th>Autor</th>
                    <th>Detalles</th>
                    <th>Clasificación</th>
                    <th>Departamento</th>
                    <th>Auxiliar de Soporte</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ticketsPorDepartamento as $ticket)
                    <tr>
                        <td>{{ $ticket->ID_tickets }}</td>
                        <td>{{$ticket ->Nombre}}</td>
                        <td>{{ $ticket->Detalles }}</td>
                        <td>{{ $ticket->Clasificacion }}</td>
                        <td>{{ $ticket->departamento }}</td>
                        <td>
                            @if ($ticket->auxiliar_Soporte == null)
                                Sin asignar
                            @else
                                {{ $ticket->auxiliar_Soporte }}
                            @endif
                        </td>
                        <td>{{ $ticket->fecha }}</td>
                        <td>{{ $ticket->estatus }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>



</html>
