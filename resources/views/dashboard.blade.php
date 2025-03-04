@extends('layout')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-green-700 flex items-center gap-2">
                🦖 Dashboard Tugasaurus
            </h1>
            <div class="flex gap-2">
                <a href="/tasks"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Daftar
                    Tugas</a>
                <a href="/logout"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Logout</a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Tasks Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Tugas</p>
                        <h3 class="text-2xl font-bold">{{ $totalTasks }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>
    
            <!-- Completed Tasks Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Tugas Selesai</p>
                        <h3 class="text-2xl font-bold">{{ $completedTasks }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>
    
            <!-- Pending Tasks Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Tugas Pending</p>
                        <h3 class="text-2xl font-bold">{{ $pendingTasks }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
    
            <!-- High Priority Tasks Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Prioritas Tinggi</p>
                        <h3 class="text-2xl font-bold">{{ $highPriorityTasks }}</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Tasks Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 col-span-3">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Tugas Hari Ini</h2>
                    <button onclick="openModal('today')"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        + Tambah Tugas
                    </button>
                </div>

                @if ($recentTasks->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-gray-500">
                        <p class="text-lg">Belum ada tugas untuk hari ini</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($recentTasks as $task)
                        <div class="bg-gray-100 p-4 rounded-lg task-card cursor-pointer" 
                        onclick="showTaskDetails({{ $task->id }})"
                        data-priority="{{ $task->priority }}"
                        style="background-color: {{ getPriorityColor($task->priority) }}">
                       <div class="flex justify-between items-center">
                           <span class="font-medium">{{ $task->title }}</span>
                           <div class="flex items-center">
                               <button 
                                   class="mr-3 px-2 py-1 rounded-md text-white {{ $task->completed ? 'bg-green-600' : 'bg-blue-600' }}"
                                   onclick="markAsCompleted({{ $task->id }}, event)">
                                   {{ $task->completed ? 'Completed' : 'Mark Complete' }}
                               </button>
                               <span class="text-center text-sm">
                                   <div class="text-gray-700">{{ date('d M Y', strtotime($task->deadline)) }}</div>
                                   <div class="text-gray-800 font-semibold">{{ date('H:i', strtotime($task->deadline)) }}</div>
                               </span>
                           </div>
                       </div>
                   </div>
                   
                   <!-- Task Details Modal -->
                   <div id="taskModal-{{ $task->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                       <div class="bg-white p-6 rounded-lg w-full max-w-md">
                           <div class="flex justify-between items-center mb-4">
                               <h2 class="text-xl font-bold">{{ $task->title }}</h2>
                               <button onclick="closeTaskDetails({{ $task->id }})" class="text-gray-600 hover:text-gray-800">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                   </svg>
                               </button>
                           </div>
                           <div class="mb-4">
                               <p class="text-gray-700 mb-2"><strong>Description:</strong></p>
                               <p class="text-gray-600">{{ $task->description }}</p>
                           </div>
                           <div class="grid grid-cols-2 gap-4 mb-4">
                               <div>
                                   <p class="text-gray-700"><strong>Deadline Date:</strong></p>
                                   <p class="text-gray-600">{{ date('d M Y', strtotime($task->deadline)) }}</p>
                               </div>
                               <div>
                                   <p class="text-gray-700"><strong>Deadline Time:</strong></p>
                                   <p class="text-gray-600">{{ date('H:i', strtotime($task->deadline)) }}</p>
                               </div>
                               <div>
                                   <p class="text-gray-700"><strong>Priority:</strong></p>
                                   <p class="text-gray-600">{{ ucfirst($task->priority) }}</p>
                               </div>
                               <div>
                                   <p class="text-gray-700"><strong>Status:</strong></p>
                                   <p class="text-gray-600">{{ $task->completed ? 'Completed' : 'Pending' }}</p>
                               </div>
                           </div>
                           <div class="flex justify-end">
                               <button 
                                   class="px-4 py-2 rounded-md text-white {{ $task->completed ? 'bg-green-600' : 'bg-blue-600' }}"
                                   onclick="markAsCompleted({{ $task->id }})">
                                   {{ $task->completed ? 'Completed' : 'Mark as Complete' }}
                               </button>
                           </div>
                       </div>
                   </div>
                   
                   <script>
                       // Function to get priority color based on priority level
                       function getPriorityColor(priority) {
                           switch(priority.toLowerCase()) {
                               case 'high':
                                   return '#FEE2E2'; // light red
                               case 'medium':
                                   return '#FEF3C7'; // light yellow
                               case 'low':
                                   return '#D1FAE5'; // light green
                               default:
                                   return '#F3F4F6'; // light gray
                           }
                       }
                       
                       // Apply priority colors to all task cards
                       document.addEventListener('DOMContentLoaded', function() {
                           const taskCards = document.querySelectorAll('.task-card');
                           taskCards.forEach(card => {
                               const priority = card.dataset.priority;
                               card.style.backgroundColor = getPriorityColor(priority);
                           });
                       });
                       
                       // Show task details
                       function showTaskDetails(taskId) {
                           document.getElementById(`taskModal-${taskId}`).classList.remove('hidden');
                       }
                       
                       // Close task details
                       function closeTaskDetails(taskId) {
                           document.getElementById(`taskModal-${taskId}`).classList.add('hidden');
                       }
                       
                       // Mark task as completed
                       function markAsCompleted(taskId, event) {
                           if (event) {
                               event.stopPropagation(); // Prevent opening the modal when clicking the button
                           }
                           
                           // AJAX request to mark task as completed
                           fetch(`/tasks/${taskId}/complete`, {
                               method: 'POST',
                               headers: {
                                   'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                   'Accept': 'application/json',
                                   'Content-Type': 'application/json'
                               },
                           })
                           .then(response => response.json())
                           .then(data => {
                               if (data.success) {
                                   // Update UI
                                   location.reload(); // Quick solution - refresh the page
                                   // Alternatively, you can update the UI without refreshing
                               }
                           })
                           .catch(error => console.error('Error:', error));
                       }
                   </script>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 col-span-1">
                <h2 class="text-lg font-semibold mb-4">Progress Hari Ini</h2>
                <div class="flex justify-center">
                    <div class="w-48 h-48 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" stroke="currentColor" 
                                    stroke-width="10" fill="none" 
                                    class="text-gray-200"/>
                            <circle cx="50" cy="50" r="45" stroke="currentColor"
                                    stroke-width="10" fill="none"
                                    stroke-dasharray="{{ $todayProgress * 2.83 }}, 283"
                                    class="text-green-600 transition-all duration-1000"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-3xl font-bold text-green-700">{{ $todayProgress }}%</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 space-y-2">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $todayProgress ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Future Tasks Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 col-span-3">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Tugas Mendatang</h2>
                    <button onclick="openModal('custom')"
                        class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2">
                        + Tambah Tugas
                    </button>
                </div>

                @if ($futureTasks->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-gray-500">
                        <p class="text-lg">Belum ada tugas mendatang</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($futureTasks as $task)
                            <div class="bg-gray-100 p-4 rounded-lg flex justify-between">
                                <span>{{ $task->title }}</span>
                                <span class="text-sm text-gray-500">{{ $task->deadline }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 col-span-1">
                <h2 class="text-lg font-semibold mb-4">Progress Tugas Mendatang</h2>
                <div class="mt-6 space-y-2">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ $futureProgress ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Kalender Tugas</h2>
                <button onclick="openModal('custom')"
                    class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2">
                    + Tambah Tugas
                </button>
            </div>
        
            <div class="mb-4">
                <label for="filter" class="font-medium text-sm text-gray-700">Filter:</label>
                <select id="filter" class="ml-2 border rounded p-1 text-sm" onchange="updateCalendar()">
                    <option value="date">Berdasarkan Tanggal</option>
                    <option value="task">Berdasarkan Tugas</option>
                </select>
            </div>
        
            <div id="calendar" class="grid grid-cols-7 gap-2 text-center">
                @php
                    $today = now();
                    $daysToShow = 7;
                    $taskDates = $futureTasks->pluck('deadline')->unique()->sort();
                    $filteredDates = request('filter') === 'task' ? $taskDates->take(7) : collect(range(0, 6))->map(fn($i) => $today->copy()->addDays($i)->format('Y-m-d'));
                @endphp
        
                @foreach ($filteredDates as $date)
                    @php
                        $taskOnDate = $futureTasks->where('deadline', $date);
                        $priorityClass = 'bg-gray-100';
                        if (!$taskOnDate->isEmpty()) {
                            $priorities = $taskOnDate->pluck('priority')->map(function ($p) {
                                return match ($p) {
                                    'urgent' => 4,
                                    'high' => 3,
                                    'medium' => 2,
                                    'low' => 1,
                                    default => 0,
                                };
                            });
                            $highestPriority = $priorities->max();
                            $priorityClass = match ($highestPriority) {
                                4 => 'bg-red-500 text-white',
                                3 => 'bg-orange-400 text-white',
                                2 => 'bg-yellow-300',
                                1 => 'bg-green-300',
                                default => 'bg-gray-100',
                            };
                        }
                    @endphp
        
                    <div class="border p-2 rounded-lg w-16 h-16 flex flex-col items-center justify-center {{ $priorityClass }}">
                        <span class="font-semibold">{{ date('d', strtotime($date)) }}</span>
                        @if (!$taskOnDate->isEmpty())
                            <span class="text-xs font-semibold">{{ $taskOnDate->count() }} Tugas</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        
        <script>
            function updateCalendar() {
                const filter = document.getElementById('filter').value;
                window.location.href = `?filter=${filter}`;
            }
        </script>
        

        @include('components.add-task-modal')
    </div>
@endsection
