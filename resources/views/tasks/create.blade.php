<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            ✏️ Добавить задачу
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg p-8 p-4">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">Заполните форму для добавления новой задачи</h1>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-8 p-4">
                    <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Название</label>
                    <input type="text" name="title" id="title"
                           class="w-full px-5 py-3 border border-gray-300 rounded-md text-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-8 p-4">
                    <label for="description" class="block text-lg font-semibold text-gray-700 mb-2">Описание</label>
                    <textarea name="description" id="description" rows="5"
                              class="w-full px-5 py-3 border border-gray-300 rounded-md text-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="mb-8 p-4">
                    <label for="status" class="block text-lg font-semibold text-gray-700 mb-2">Статус</label>
                    <select name="status" id="status"
                            class="w-full px-5 py-3 border border-gray-300 rounded-md text-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="new">🆕 Новый</option>
                        <option value="in_progress">🔄 В процессе</option>
                        <option value="done">✅ Завершена</option>
                    </select>
                </div>


                <div class="flex justify-end  p-4">
                    <button type="submit" style="background-color: green"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3  p-2 px-8 rounded-lg shadow-md text-lg transition-all duration-300">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
