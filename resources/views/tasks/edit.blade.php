<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            ✏️ Редактировать задачу
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg p-15 p-4">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">Редактировать задачу</h1>

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-8 p-4">
                    <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Название</label>
                    <input type="text" name="title" id="title"
                           class="w-full px-5 py-3 border border-gray-300 rounded-md text-lg shadow-sm focus:ring-2
                            focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                           value="{{ $task->title }}" required>
                </div>

                <div class="mb-8 p-4">
                    <label for="description" class="block text-lg font-semibold text-gray-700 mb-2">Описание</label>
                    <textarea name="description" id="description" rows="5"
                              class="w-full px-5 py-3 border border-gray-300 rounded-md text-lg shadow-sm focus:ring-2
                                      focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        {{ old('description', $task->description) }}</textarea>
                </div>

                <div class="mb-8 p-4">
                    <label for="status" class="block text-lg font-semibold text-gray-700 mb-2">Статус</label>
                    <div class="relative">
                        <select name="status" id="status"
                                class="w-full px-5 py-3 border border-gray-300 rounded-md text-lg shadow-sm appearance-none
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                            <option value="new" {{ $task->status == 'new' ? 'selected' : '' }}>🆕 Новый</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>🔄 В
                                процессе
                            </option>
                            <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>✅ Завершена</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end p-4">
                    <button type="submit" style="background-color: green"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-md shadow-md
                             text-lg transition-all duration-300 p-2">
                        Обновить
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
