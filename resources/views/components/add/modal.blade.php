<div id="taskModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Add Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="hidden" id="isTodayTask" name="is_today_task" value="false">

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" required class="mt-1 p-2 w-full border rounded-lg">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3" class="mt-1 p-2 w-full border rounded-lg"></textarea>
            </div>

            <!-- Priority -->
            <div class="mb-4">
                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <select id="priority" name="priority" class="mt-1 p-2 w-full border rounded-lg">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- Deadline -->
            <div class="mb-4" id="deadlineField">
                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                <input type="date" id="deadline" name="deadline" class="mt-1 p-2 w-full border rounded-lg">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
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
    function getDateFromURL() {
        const path = window.location.pathname;
        const match = path.match(/\/tasks\/date\/(\d{4}-\d{2}-\d{2})/);
        return match ? match[1] : null;
    }

    function openModal(mode = 'url') {
        document.getElementById('taskModal').classList.remove('hidden');

        const deadline = document.getElementById('deadline');
        const isTodayInput = document.getElementById('isTodayTask');

        if (mode === 'today') {
            const today = new Date().toISOString().split('T')[0];
            deadline.value = today;
            isTodayInput.value = 'true';
        } else if (mode === 'url') {
            const urlDate = getDateFromURL();
            if (urlDate) {
                deadline.value = urlDate;
            } else {
                deadline.value = '';
            }
            isTodayInput.value = 'false';
        } else if (mode === 'custom') {
            deadline.value = '';
            isTodayInput.value = 'false';
        }
    }

    function closeModal() {
        document.getElementById('taskModal').classList.add('hidden');
    }
</script>





