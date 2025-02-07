<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-500 to-blue-500 flex items-center justify-center">
<div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8">
    <div class="text-center">
        <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" class="h-16 mx-auto">
        <h2 class="mt-4 text-3xl font-bold text-gray-800">📝 Create an Account</h2>
        <p class="text-gray-600 mt-2">Join us and start your journey</p>
    </div>

    @if (session('status'))
        <div class="mb-4 text-green-600 font-semibold text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 font-semibold">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('email')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-700 font-semibold">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('password')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg text-lg font-semibold shadow-md transition-all">
            🚀 Register
        </button>
    </form>

    <p class="text-center text-gray-600 text-sm mt-6">
        Already have an account?
        <a href="{{ route('login') }}" class="text-green-600 hover:underline">Log in</a>
    </p>
</div>
</body>
</html>
