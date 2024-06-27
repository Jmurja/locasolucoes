<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <style>
        /* Adicione estilos personalizados aqui para o PDF */
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
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
