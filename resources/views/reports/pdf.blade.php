<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Reservas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #ffffff;
            color: #333333;
        }

        h1 {
            text-align: center;
            color: #34495e;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #34495e;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        tfoot td {
            font-weight: bold;
            text-align: right;
            border: none;
        }

        .footer {
            margin-top: 10px; /* Ajuste na margem superior */
            text-align: center;
            font-size: 12px;
            color: #666666;
        }

        @media print {
            body {
                background-color: #ffffff;
            }

            @page {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
<h1>Relatórios de Reservas</h1>
<table>
    <thead>
    <tr>
        <th>Responsável</th>
        <th>Espaço</th>
        <th>Hora de Início</th>
        <th>Hora do Fim</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reserves as $reserve)
        <tr>
            <td>{{ $reserve->user->name ?? 'N/A' }}</td>
            <td>{{ $reserve->rentalitem->name ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($reserve->start_date)->format('d/m/Y, H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($reserve->end_date)->format('d/m/Y, H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">Total de Reservas: {{ $reserves->count() }}</td>
    </tr>
    </tfoot>
</table>

<div class="footer">
    Relatório gerado em {{ \Carbon\Carbon::now()->format('d/m/Y, H:i') }}.
</div>
</body>
</html>
