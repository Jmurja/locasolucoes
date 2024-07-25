<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Não Autorizado</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
<div class="text-center">
    <div class="text-9xl font-extrabold text-purple-600 animate-pulse">401</div>
    <div class="text-4xl mt-4 font-semibold">Não Autorizado</div>
    <p class="mt-2 text-lg text-gray-300">Desculpe, você não tem permissão para acessar esta página.</p>
    <a href="{{ url('/') }}"
       class="mt-8 inline-block bg-purple-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-purple-700 transition duration-300 ease-in-out">Voltar
        para a página inicial</a>
</div>
</body>
</html>
