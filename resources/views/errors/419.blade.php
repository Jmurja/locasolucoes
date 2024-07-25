<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Expirada</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
<div class="text-center">
    <div class="text-9xl font-extrabold text-orange-600 animate-pulse">419</div>
    <div class="text-4xl mt-4 font-semibold">Página Expirada</div>
    <p class="mt-2 text-lg text-gray-300">Desculpe, a página que você está tentando acessar expirou.</p>
    <a href="{{ url('/') }}"
       class="mt-8 inline-block bg-orange-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-orange-700 transition duration-300 ease-in-out">Voltar
        para a página inicial</a>
</div>
</body>
</html>
