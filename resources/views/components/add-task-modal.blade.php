<div id="taskModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Add Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="hidden" id="isTodayTask" value="false">

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

            <!-- Deadline (Hidden by Default for Today’s Tasks) -->
            <div class="mb-4" id="deadlineField">
                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                <input type="date" id="deadline" name="deadline" class="mt-1 p-2 w-full border rounded-lg">
            </div>

            <!-- Expert Mode Fields -->
            <div id="expertFields" class="hidden">
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="mt-1 p-2 w-full border rounded-lg">
                </div>
                <div class="mb-4 flex items-center">
                    <div class="w-1/2">
                        <label for="time_start" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" id="time_start" name="time_start" class="mt-1 p-2 w-full border rounded-lg">
                    </div>
                    <span class="mx-2">to</span>
                    <div class="w-1/2">
                        <label for="time_end" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" id="time_end" name="time_end" class="mt-1 p-2 w-full border rounded-lg">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="repeat_interval" class="block text-sm font-medium text-gray-700">Repeat</label>
                    <select id="repeat_interval" name="repeat_interval" class="mt-1 p-2 w-full border rounded-lg">
                        <option value="none">No Repeat</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
            </div>

            <!-- Toggle Expert Mode -->
            <label class="flex items-center cursor-pointer mb-4">
                <input type="checkbox" id="toggleExpert" class="hidden">
                <div class="w-10 h-5 bg-gray-300 rounded-full p-1 flex items-center">
                    <div id="toggleDot" class="w-4 h-4 bg-white rounded-full shadow-md transform transition"></div>
                </div>
                <span class="ml-2 text-sm">Expert Mode</span>
            </label>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
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
    function openModal(isToday = false) {
        document.getElementById('taskModal').classList.remove('hidden');
        document.getElementById('isTodayTask').value = isToday;
        
        if (isToday) {
            // Set Start Date & Deadline to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').value = today;
            document.getElementById('deadline').value = today;

        } else {
            // Clear values if not today’s task
            document.getElementById('start_date').value = '';
            document.getElementById('deadline').value = '';

            // Show Start Date & Deadline
            document.getElementById('deadlineField').classList.remove('hidden');
        }
    }

    function closeModal() {
        document.getElementById('taskModal').classList.add('hidden');
    }

    document.getElementById('toggleExpert').addEventListener('change', function() {
        const isExpert = this.checked;
        document.getElementById('expertFields').classList.toggle('hidden', !isExpert);

        if (isExpert) {
            document.getElementById('deadlineField').classList.remove('hidden');
        } else {
            // Reapply Today’s Task rules
            const isTodayTask = document.getElementById('isTodayTask').value === "true";
            if (isTodayTask) {
                document.getElementById('deadlineField').classList.add('hidden');
            }
        }

        document.getElementById('toggleDot').classList.toggle('translate-x-5');
    });
</script>
    