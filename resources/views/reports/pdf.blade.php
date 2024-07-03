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
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #000;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        @page {
            margin: 20px;
        }
    </style>
</head>
<body>
<h1>Relatórios</h1>
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
