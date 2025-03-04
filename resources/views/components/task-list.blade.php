<!-- Task Stats Component -->
@include('components.task-stat', ['taskStats' => $taskStats])

<!-- Task List Component -->
@include('components.task-list', ['taskList' => $taskList])


<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Recent Tasks -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Tugas Terbaru</h2>
        <div class="space-y-4">
            @foreach($recentTasks as $task)
            <div class="flex items-center justify-between p-4 rounded-lg {{ $task->priority === 'high' ? 'bg-red-100' : ($task->priority === 'medium' ? 'bg-yellow-100' : 'bg-purple-100') }}">
                <div class="flex items-center gap-3">
                    <input type="checkbox" 
                           class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500"
                           {{ $task->status === 'completed' ? 'checked' : '' }}
                           disabled>
                    <span class="{{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                        {{ $task->title }}
                    </span>
                </div>
                <span class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Task Completion Progress -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Progress Keseluruhan</h2>
        <div class="flex justify-center">
            <div class="w-48 h-48 relative">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" stroke="currentColor" 
                            stroke-width="10" fill="none" 
                            class="text-gray-200"/>
                    <circle cx="50" cy="50" r="45" stroke="currentColor"
                            stroke-width="10" fill="none"
                            stroke-dasharray="{{ $progress * 2.83 }}, 283"
                            class="text-green-600 transition-all duration-1000"/>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-3xl font-bold text-green-700">{{ $progress }}%</span>
                </div>
            </div>
        </div>
        <div class="mt-6 space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">Tugas Selesai</span>
                <span class="font-medium">{{ $completedTasks }} dari {{ $totalTasks }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Kalender</h2>
        <!-- Placeholder for calendar (could use a JavaScript library like FullCalendar) -->
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">Kalender (Tampilkan dengan library seperti FullCalendar)</span>
        </div>
    </div>

    <!-- Add Task Buttons -->
    <div class="flex gap-4 mb-6">
        <a href="/tasks/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Tambah Tugas</a>
        <a href="/tasks/create?tomorrow=true" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">Tambah Tugas Untuk Besok</a>
    </div>
</div>
