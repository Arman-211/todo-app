<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome | TODO App</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 min-h-screen flex flex-col justify-center items-center text-white">

<div class="text-center">
    <h1 class="text-5xl font-bold mb-4 animate-bounce">🚀 Welcome to TODO App</h1>
    <p class="text-lg opacity-80">Effortlessly manage your tasks and boost your productivity!</p>

    @auth
        <h2 class="mt-4 text-2xl font-semibold">Hello, <span class="text-yellow-300">{{ Auth::user()->name }}</span>! 👋</h2>
        <p class="mt-2">Role:
            <span class="px-3 py-1 rounded-lg font-semibold {{ Auth::user()->hasRole('admin') ? 'bg-red-600' : 'bg-green-500' }}">
                    {{ Auth::user()->hasRole('admin') ? 'Admin' : 'Guest' }}
                </span>
        </p>

        <a href="{{ route('dashboard') }}" class="mt-6 inline-block bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-200 transition-all">
            🏠 Go to Dashboard
        </a>
    @else
        <div class="mt-6">
            <a href="{{ route('login') }}" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-200 transition-all mx-2">
                🔑 Login
            </a>
            <a href="{{ route('register') }}" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-700 transition-all mx-2">
                📝 Register
            </a>
        </div>
    @endauth
</div>

<footer class="absolute bottom-4 text-sm opacity-80">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
</footer>

</body>
</html>
