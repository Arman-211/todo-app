<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center">
<div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8">
    <!-- Логотип -->
    <div class="text-center">
        <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" class="h-16 mx-auto">
        <h2 class="mt-4 text-3xl font-bold text-gray-800">🔑 Welcome Back!</h2>
        <p class="text-gray-600 mt-2">Log in to access your account</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-green-600 font-semibold text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- Форма -->
    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('email')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-gray-700 font-semibold">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('password')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:underline">Forgot Password?</a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg text-lg font-semibold shadow-md transition-all">
            🚀 Log in
        </button>
    </form>

    <!-- Register -->
    <p class="text-center text-gray-600 text-sm mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-purple-600 hover:underline">Sign up</a>
    </p>
</div>
</body>
</html>
