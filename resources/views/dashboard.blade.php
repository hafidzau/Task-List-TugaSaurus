@extends('layout')

@section('content')
    <div class="container mx-auto p-4">
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

        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <h2 class="text-xl font-semibold text-gray-800">📅 Kalender Tugas</h2>
            </div>
        
            <div class="flex items-center gap-2 mb-4">
                <label for="filter" class="text-sm font-medium text-gray-700">Filter:</label>
                <select id="filter"
                    class="border-gray-300 rounded-md text-sm p-1.5 shadow-sm focus:ring-yellow-400 focus:border-yellow-400 transition-all"
                    onchange="location.href='?filter=' + this.value">
                    <option value="date" {{ request('filter') === 'date' ? 'selected' : '' }}>Berdasarkan Tanggal</option>
                    <option value="task" {{ request('filter') === 'task' ? 'selected' : '' }}>Berdasarkan Tugas</option>
                </select>
            </div>
        
            <div id="calendar" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-4">
                @php
                    $today = now();
                    $daysToShow = 7;
                    $taskDates = $futureTasks?->pluck('deadline')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))->unique()->sort();
        
                    $filter = request('filter') ?? 'date';
                    $filteredDates = $filter === 'task'
                        ? $taskDates->take($daysToShow)
                        : collect(range(0, $daysToShow - 1))->map(fn($i) => $today->copy()->addDays($i)->format('Y-m-d'));
                @endphp
        
                @foreach ($filteredDates as $date)
                    @php
                        $taskOnDate = $futureTasks->filter(fn($task) => \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') === $date);
        
                        $priorityClass = 'bg-gray-100 text-gray-700';
                        if ($taskOnDate->isNotEmpty()) {
                            $priorities = $taskOnDate->pluck('priority')->map(fn($p) => match ($p) {
                                'urgent' => 4,
                                'high' => 3,
                                'medium' => 2,
                                'low' => 1,
                                default => 0,
                            });
                            $highestPriority = $priorities->max();
                            $priorityClass = match ($highestPriority) {
                                4 => 'bg-red-500 text-white',
                                3 => 'bg-orange-400 text-white',
                                2 => 'bg-yellow-300 text-black',
                                1 => 'bg-green-300 text-black',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        }
                    @endphp
        
                    <div class="border rounded-xl p-3 h-20 flex flex-col items-center justify-center text-sm font-medium {{ $priorityClass }} transition-all duration-200">
                        <span class="text-base font-semibold">{{ \Carbon\Carbon::parse($date)->format('d') }}</span>
                        @if ($taskOnDate->isNotEmpty())
                            <span class="text-xs">{{ $taskOnDate->count() }} Tugas</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        
        
        

        <!-- Today's Tasks Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-10 mb-8">
            <!-- Tugas Hari Ini -->
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
                            <x-task.list :task="$task" />
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Progress Hari Ini -->
            <div class="bg-white rounded-lg shadow-md p-6 col-span-1">
                <h2 class="text-lg font-semibold mb-4">Progress Hari Ini</h2>
            
                <!-- Progress Circle -->
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
            
                        <!-- Percentage text inside the circle -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-3xl font-bold text-green-700">{{ $todayProgress }}%</span>
                        </div>
                    </div>
                </div>
            
                <!-- Progress Status (0/0) -->
                <div class="mt-6 space-y-2 text-center text-gray-600">
                    <span class="text-lg font-semibold">{{ $completedTasks }}/{{ $todayTasksCount }}</span>
                </div>
            </div>            
        </div>
        

        <!-- Future Tasks Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt">
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
                <h2 class="text-lg font-semibold mb-4">tugas terlewat</h2>
                <div class="mt-6 space-y-2">
                    
                </div>
            </div>
        </div>

        
        <script>
            function updateCalendar() {
                const filter = document.getElementById('filter').value;
                window.location.href = `?filter=${filter}`;
            }
        </script>
        

        @include('components.add.modal')
    </div>

    
@endsection
