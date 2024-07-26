<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e9e9e9;
        }

        @media print {
            body {
                background-color: #fff;
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
</table>
</body>
</html>
