<x-detail id="taskDetailsModal" title="Detail Tugas">
    <div v-if="selectedTask" class="space-y-4">
        <div>
            <strong class="text-gray-700">Deskripsi:</strong>
            <p class="text-gray-600">@{{ selectedTask.description }}</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <strong class="text-gray-700">Deadline:</strong>
                <p class="text-gray-600">@{{ selectedTask.formatted_deadline }}</p>
            </div>
            <div>
                <strong class="text-gray-700">Prioritas:</strong>
                <p class="text-gray-600">@{{ selectedTask.priority }}</p>
            </div>
            <div>
                <strong class="text-gray-700">Status:</strong>
                <p class="text-gray-600">@{{ selectedTask.completed ? 'Selesai' : 'Sedang Berlangsung' }}</p>
            </div>
        </div>
        <div class="flex justify-end space-x-2">
            <button 
                @click="markTaskCompleted(selectedTask.id)" 
                class="btn {{ $task->completed ? 'btn-success' : 'btn-primary' }}">
                @{{ selectedTask.completed ? 'Selesai' : 'Tandai Selesai' }}
            </button>
        </div>
    </div>
</x-detail>