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
            width: auto;
            border-collapse: collapse;
            scale:0.8;
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
@foreach ($tickets->groupBy('estatus') as $nombre_auxiliar => $ticketsPorNombreAuxiliar)
    <h2>{{ $nombre_auxiliar }}</h2>
    <h1>Reporte de Tickets</h1>
    <table>
        <thead>
            <tr>
                <th>No. Ticket</th>
                <th>Autor</th>
                <th>Departamento</th>
                <th>Fecha</th>
                <th>Clasificación</th>
                <th>Detalles</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsPorNombreAuxiliar as $ticket)
                <tr>
                    <td>{{ $ticket->ID_tickets }}</td>
                    <td>{{ $ticket->nombre_usuario }}</td>
                    <td>{{ $ticket->departamento_usuario }}</td>
                    <td>{{ $ticket->fecha }}</td>
                    <td>{{ $ticket->Clasificacion }}</td>
                    <td>{{ $ticket->Detalles }}</td>
                    <td>{{ $ticket->estatus }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
</body>


</html>
