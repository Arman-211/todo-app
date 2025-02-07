<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Ваши задачи</h3>
                    <a href="{{ route('tasks.create') }}" style="background-color: purple"
                       class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        <span class="mr-2">➕</span> Добавить задачу
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-500 text-white px-5 py-3 rounded-lg shadow-md mb-4 transition-all duration-500">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-hidden rounded-lg border border-gray-300">
                    <table class="w-full bg-white text-sm rounded-lg">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="py-4 px-6 text-left text-gray-700 font-bold uppercase w-1/12">ID</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-bold uppercase w-2/12">Название</th>
                            <th class="py-4 px-6 text-center text-gray-700 font-bold uppercase w-2/12">Статус</th>
                            <th class="py-4 px-6 text-center text-gray-700 font-bold uppercase w-4/12">Описание</th>
                            <th class="py-4 px-6 text-center text-gray-700 font-bold uppercase w-2/12">Создатель</th>
                            <th class="py-4 px-6 text-center text-gray-700 font-bold uppercase w-2/12">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr class="border-t border-gray-200 hover:bg-gray-50 transition">
                                <td class="py-4 px-6 text-gray-900">{{ $task->id }}</td>
                                <td class="py-4 px-6 text-gray-900">{{ $task->title }}</td>
                                <td class="py-4 px-6 text-center">
                                    @php
                                        $statusColors = [
                                            'new' => 'bg-blue-500',
                                            'in_progress' => 'bg-yellow-500',
                                            'done' => 'bg-green-500',
                                        ];
                                        $statusLabels = [
                                            'new' => '🆕 Новый',
                                            'in_progress' => '🔄 В процессе',
                                            'done' => '✅ Завершена',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$task->status] ?? 'bg-gray-500 text-black' }}">
                                        {{ $statusLabels[$task->status] ?? 'Неизвестно' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center text-gray-700">
                                    <span class="block overflow-hidden text-ellipsis max-w-xs">{{ $task->description }}</span>
                                </td>
                                <td class="py-4 px-6 text-center text-gray-700">
                                    {{ $task->user->name }}
                                </td>
                                <td class="py-4 px-6 text-center flex justify-center items-center gap-4">
                                    <a href="{{ route('tasks.edit', $task) }}" style="background-color: darkorange"
                                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition-all duration-300 flex items-center gap-2">
                                        Редактировать
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition-all duration-300 flex items-center gap-2"
                                                onclick="return confirm('Удалить задачу?')">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
