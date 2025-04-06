<div id="todayTaskModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Add Today Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <!-- Title -->
            <div class="mb-4">
                <label for="today_title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="today_title" name="title" required class="mt-1 p-2 w-full border rounded-lg">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="today_description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="today_description" name="description" rows="3" class="mt-1 p-2 w-full border rounded-lg"></textarea>
            </div>

            <!-- Priority -->
            <div class="mb-4">
                <label for="today_priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <select id="today_priority" name="priority" class="mt-1 p-2 w-full border rounded-lg">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeTodayTaskModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTodayTaskModal() {
        document.getElementById('todayTaskModal').classList.remove('hidden');
    }

    function closeTodayTaskModal() {
        document.getElementById('todayTaskModal').classList.add('hidden');
    }
</script>
