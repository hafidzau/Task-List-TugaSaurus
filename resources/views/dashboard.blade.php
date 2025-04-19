@extends('layout')

@section('content')
    <div class="container mx-auto p-4">

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5 mb-6">
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Tugas</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $totalTasks }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tugas Selesai</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $completedTasks }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tugas Pending</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $pendingTasks }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Prioritas Tinggi</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $highPriorityTasks }}</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-5">
                <h2 class="text-xl font-semibold text-gray-800">📅 Kalender Tugas</h2>

                <div class="flex items-center gap-2 mt-3 sm:mt-0">
                    <label for="filter" class="text-sm font-medium text-gray-600">Filter:</label>
                    <select id="filter"
                        class="border border-gray-300 rounded-md text-sm p-1.5 shadow-sm focus:ring-yellow-400 focus:border-yellow-400"
                        onchange="location.href='?filter=' + this.value">
                        <option value="date" {{ request('filter') === 'date' ? 'selected' : '' }}>Berdasarkan Tanggal
                        </option>
                        <option value="task" {{ request('filter') === 'task' ? 'selected' : '' }}>Berdasarkan Tugas
                        </option>
                    </select>
                </div>
            </div>

            <div id="calendar" class="grid grid-cols-7 gap-2">
                @php
                    $today = now();
                    $daysToShow = 7;
                    $taskDates = $futureTasks
                        ?->pluck('deadline')
                        ->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))
                        ->unique()
                        ->sort();

                    $filter = request('filter') ?? 'date';
                    $filteredDates =
                        $filter === 'task'
                            ? $taskDates->take($daysToShow)
                            : collect(range(0, $daysToShow - 1))->map(
                                fn($i) => $today->copy()->addDays($i)->format('Y-m-d'),
                            );
                @endphp

                @foreach ($filteredDates as $date)
                    @php
                        $taskOnDate = $futureTasks->filter(
                            fn($task) => \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') === $date,
                        );

                        $priorityClass = 'bg-gray-100 text-gray-700';
                        if ($taskOnDate->isNotEmpty()) {
                            $priorities = $taskOnDate->pluck('priority')->map(
                                fn($p) => match ($p) {
                                    'high' => 3,
                                    'medium' => 2,
                                    'low' => 1,
                                    default => 0,
                                },
                            );
                            $highestPriority = $priorities->max();
                            $priorityClass = match ($highestPriority) {
                                3 => 'bg-rose-500 text-white',
                                2 => 'bg-amber-400 text-black',
                                1 => 'bg-emerald-500 text-white',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        }
                    @endphp

                    <div
                        class="border rounded-lg p-3 h-16 flex flex-col items-center justify-center text-sm font-medium {{ $priorityClass }}">
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
                        @foreach ($recentTasks->take(3) as $task)
                            <x-task.list :task="$task" />
                        @endforeach
                    </div>
                @endif

                <!-- Button to navigate to the /today page -->
                <div class="mt-6 flex justify-center">
                    <a href="/today"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                        Lihat Semua Tugas
                    </a>
                </div>
            </div>



            <!-- Progress Hari Ini -->
            <div class="bg-white rounded-lg shadow-md p-6 col-span-1">
                <h2 class="text-lg font-semibold mb-4">Progress Hari Ini</h2>

                <!-- Progress Circle -->
                <div class="flex justify-center">
                    <div class="w-48 h-48 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="10"
                                fill="none" class="text-gray-200" />
                            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="10"
                                fill="none" stroke-dasharray="{{ $todayProgress * 2.83 }}, 283"
                                class="text-green-600 transition-all duration-1000" />
                        </svg>

                        <!-- Percentage text inside the circle -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-3xl font-bold text-green-700">{{ $todayProgress }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Status (X/Y) -->
                <div class="mt-6 space-y-2 text-center text-gray-600">
                    <span class="text-lg font-semibold">{{ $todayCompletedCount }}/{{ $todayTasksCount }}</span>
                </div>
            </div>

        </div>


        <!-- Future Tasks Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
            <!-- Tugas Mendatang -->
            <div class="bg-white rounded-lg shadow-md p-6 col-span-3 flex flex-col max-h-[300px]">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Tugas Mendatang</h2>
                    <button onclick="openModal('custom')"
                        class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2">
                        + Tambah Tugas
                    </button>
                </div>

                @if ($futureTasks->isEmpty())
                    <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                        <p class="text-lg font-medium">Belum ada tugas mendatang</p>
                    </div>
                @else
                    <div class="space-y-4 overflow-y-auto pr-2 flex-1">
                        @foreach ($futureTasks as $task)
                            <div class="bg-white p-4 rounded-xl shadow-sm border flex items-center justify-between hover:shadow-md transition">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-800">{{ $task->title }}</span>
                                </div>
                                <div class="text-sm text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- Tugas Terlewat -->
            <div class="bg-white rounded-lg shadow-md p-6 col-span-1 flex flex-col max-h-[300px]">
                <h2 class="text-lg font-semibold mb-4 text-red-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.707a1 1 0 00-1.414 0L7 9.586 6.293 8.879a1 1 0 00-1.414 1.414L7 12.414l4.121-4.121a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                    Tugas Terlewat
                </h2>
            
                @if ($missedTasks->isEmpty())
                    <div class="flex-1 flex flex-col items-center justify-center text-gray-500">
                        <p class="text-lg italic">Tidak ada tugas yang terlewat 😊</p>
                    </div>
                @else
                    <div class="space-y-4 overflow-y-auto pr-2 flex-1">
                        @foreach ($missedTasks as $task)
                            <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 font-medium">{{ $task->title }}</span>
                                    <span class="text-sm text-red-400 italic">Waktu telah berlalu...</span>
                                </div>
                                <span class="text-sm text-red-600 font-semibold">💔 Terlambat</span>
                            </div>
                        @endforeach
                    </div>
                @endif
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
