<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Добро пожаловать в панель управления,') }} {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-gray-800">Привет, {{ auth()->user()->name }}!</h3>
                    <p class="mt-4 text-lg text-gray-600">Добро пожаловать в вашу панель управления. Здесь вы можете просматривать и управлять своими задачами.</p>
                </div>
            </div>
            <br>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-xl font-semibold text-gray-700">Всего задач</h4>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalTasks }}</p>
                </div>
                <br>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-xl font-semibold text-gray-700">Завершенные задачи</h4>
                    <p class="text-2xl font-bold text-green-500">{{ $completedTasks }}</p>
                </div>
                <br>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-xl font-semibold text-gray-700">Напоминания</h4>
                    <p class="text-lg text-gray-600">Не забудьте завершить текущие задачи!</p>
                </div>
            </div>
            <br>
            <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800">Прогресс задач</h3>
                <div class="w-full bg-gray-300 rounded-full mt-4">
                    <div class="bg-green-500 text-xs font-semibold text-center p-1 leading-none rounded-full" style="width: {{ $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0 }}%; font-size: 30px; color: green">
                        {{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) . '%' : '0%' }}
                    </div>
                </div>
            </div>
             <br>
            <div class="mt-8 bg-blue-100 text-blue-700 p-4 rounded-lg" style="color: blue">
                <strong style="color:#000;">Уведомление:</strong> У вас есть {{ $totalTasks - $completedTasks }} незавершенные задачи.
            </div>
            <br>
            <div class="mt-8 bg-white shadow-lg rounded-lg p-4" style="width: 500px!important;">
                <h3 class="text-xl font-semibold text-gray-800">Статистика задач</h3>
                <div class="mt-4">
                    <canvas id="taskStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('taskStatusChart').getContext('2d');
        const taskStatusChart = new Chart(ctx, {
            type: 'pie', // Пироговый график
            data: {
                labels: ['Завершено', 'В процессе', 'Новые'],
                datasets: [{
                    label: 'Статистика задач',
                    data: [
                        @json($completedTasks),
                        @json($inProgressTasks),
                        @json($newTasks)
                    ],
                    backgroundColor: ['#4CAF50', '#FFEB3B', '#2196F3'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            }
        });
    </script>
</x-app-layout>
