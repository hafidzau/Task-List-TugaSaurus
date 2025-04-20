<!-- resources/views/dashboard.blade.php -->
@extends('layout')

@section('content')
    <div class="container mx-auto p-6">

        <!-- Welcome message with date -->
        <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-xl p-6 mb-8 shadow-sm border border-green-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
                <div class="flex items-center gap-2 bg-white py-2 px-4 rounded-lg shadow-sm">
                    <span class="text-gray-500 text-sm">Progress Bulan Ini:</span>
                    <div class="w-32 bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $monthlyProgress }}%"></div>
                    </div>
                    <span class="font-medium text-gray-700">{{ $monthlyProgress }}%</span>
                </div>
            </div>
        </div>

        <!-- Stats Grid with improved visual design -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Tasks Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Tugas</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalTasks }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Tasks Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tugas Selesai</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $completedTasks }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2 text-sm text-gray-500">
                    {{-- <span class="{{ $completedTasks > $lastWeekCompleted ? 'text-green-500' : 'text-red-500' }}">
                    {{ $completedTasks > $lastWeekCompleted ? '+' : '' }}{{ $completedTasks - $lastWeekCompleted }}
                </span>  --}}
                    dari minggu lalu
                </div>
            </div>

            <!-- Pending Tasks Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tugas Pending</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $pendingTasks }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-lg text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                @if ($upcomingDeadlines > 0)
                    <div class="mt-2 text-sm text-red-500">
                        {{ $upcomingDeadlines }} deadline dalam 48 jam
                    </div>
                @endif
            </div>

            <!-- High Priority Tasks Card -->
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Prioritas Tinggi</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $highPriorityTasks }}</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2 text-sm">
                    {{-- <span class="{{ $highPriorityCompleted > 0 ? 'text-green-500' : 'text-gray-500' }}">
                    {{ $highPriorityCompleted }} selesai
                </span>  --}}
                    dari total
                </div>
            </div>
        </div>

        <!-- Recent Tasks and Calendar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Tasks with interactive functionality -->
            <div
                class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Tugas Terbaru</h2>
                    <a href="/tasks" class="text-sm text-green-600 hover:text-green-700 flex items-center gap-1">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                @if (count($recentTasks) > 0)
                    <div class="space-y-3">
                        @foreach ($recentTasks as $task)
                            <div
                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-all duration-150 border {{ $task->status === 'completed' ? 'border-green-200' : ($task->priority === 'high' ? 'border-red-200' : ($task->priority === 'medium' ? 'border-yellow-200' : 'border-gray-200')) }}">
                                <form action="/tasks/toggle-status/{{ $task->id }}" method="POST" class="mr-3">
                                    @csrf
                                    <button type="submit" class="flex items-center justify-center">
                                        <div
                                            class="w-5 h-5 rounded-full border {{ $task->status === 'completed' ? 'bg-green-500 border-green-500' : 'border-gray-300' }} flex items-center justify-center">
                                            @if ($task->status === 'completed')
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @endif
                                        </div>
                                    </button>
                                </form>

                                <div class="flex-1">
                                    <a href="/tasks/{{ $task->id }}" class="block">
                                        <div class="flex flex-col">
                                            <span
                                                class="{{ $task->status === 'completed' ? 'line-through text-gray-500' : 'text-gray-800' }} font-medium">
                                                {{ $task->title }}
                                            </span>
                                            <div class="flex items-center mt-1 text-xs">
                                                <span class="flex items-center text-gray-500">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                                </span>
                                                @if ($task->priority)
                                                    <span
                                                        class="ml-3 px-2 py-0.5 rounded-full text-xs
                                        {{ $task->priority === 'high'
                                            ? 'bg-red-100 text-red-700'
                                            : ($task->priority === 'medium'
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : 'bg-blue-100 text-blue-700') }}">
                                                        {{ ucfirst($task->priority) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="text-gray-400">
                                    <div class="dropdown relative">
                                        <button class="p-1 rounded-full hover:bg-gray-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-gray-500">Belum ada tugas terbaru</p>
                        <a href="/tasks/create" class="mt-3 inline-block text-sm text-green-600 hover:text-green-700">+
                            Tambah Tugas Baru</a>
                    </div>
                @endif
            </div>

            <!-- Integrated Calendar Section -->
            <div
                class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Kalender Tugas</h2>
                        <span id="current-month-display" class="ml-2 text-gray-500 font-medium"></span>
                    </div>
                    <div class="flex gap-2">
                        <button id="prev-month" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="next-month" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Day of week header -->
                <div class="grid grid-cols-7 mb-2">
                    @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                        <div class="text-center text-sm font-medium text-gray-500 py-2">{{ $day }}</div>
                    @endforeach
                </div>

                <!-- Calendar grid -->
                <div id="calendar-grid" class="grid grid-cols-7 gap-1" style="min-height: 360px;">
                    <!-- Calendar days will be inserted here by JavaScript -->
                </div>

                <!-- Priority Legend -->
                <div class="mt-6 border-t border-gray-100 pt-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Prioritas Tugas:</h3>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-rose-500 mr-2"></div>
                            <span class="text-sm text-gray-600">Tinggi:</span>
                            <span id="high-priority-count" class="text-sm font-medium ml-1">0</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-amber-400 mr-2"></div>
                            <span class="text-sm text-gray-600">Sedang:</span>
                            <span id="medium-priority-count" class="text-sm font-medium ml-1">0</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-emerald-500 mr-2"></div>
                            <span class="text-sm text-gray-600">Rendah:</span>
                            <span id="low-priority-count" class="text-sm font-medium ml-1">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Task Details -->
            <div id="task-modal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-screen overflow">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">Tugas Tanggal</h3>
                            <button id="close-modal" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Modal content with hidden scrollbar but scrollable -->
                    <div class="px-6 py-4 overflow-y-auto max-h-96" id="modal-content">
                        <!-- Task list will be dynamically inserted here -->
                    </div>
                    <div class="px-6 py-3 bg-gray-50 flex justify-end rounded-b-lg">
                        <button id="modal-close-btn"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Tutup
                        </button>
                        <a id="view-date-btn" href="#"
                            class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Lihat semua tugas
                        </a>
                    </div>
                </div>
            </div>



        </div>

        <!-- Task Progress and Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
            <!-- Task Completion Progress -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Progress Keseluruhan</h2>
                <div class="flex justify-center mb-4">
                    <div class="w-40 h-40 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="8"
                                fill="none" class="text-gray-200" />
                            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="8"
                                fill="none" stroke-dasharray="{{ $progress * 2.83 }}, 283"
                                class="text-green-600 transition-all duration-1000" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                            <span class="text-3xl font-bold text-green-700">{{ $progress }}%</span>
                            <span class="text-sm text-gray-500">Selesai</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Tugas Selesai</span>
                        <span class="font-medium">{{ $completedTasks }} dari {{ $totalTasks }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Target Mingguan</span>
                        <span class="font-medium">{{ $weeklyCompleted }} dari {{ $weeklyTarget }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full"
                            style="width: {{ ($weeklyCompleted / $weeklyTarget) * 100 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Task Distribution -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Tugas</h2>
                <div class="flex items-center justify-center h-40">
                    <div class="w-full flex items-end justify-around h-32">
                        <div class="flex flex-col items-center">
                            <div class="h-full flex items-end">
                                <div class="bg-red-500 w-12 rounded-t-lg"
                                    style="height: {{ ($highPriorityTasks / max($totalTasks, 1)) * 100 }}%"></div>
                            </div>
                            <span class="text-xs mt-2 text-gray-600">Tinggi</span>
                            <span class="text-sm font-medium">{{ $highPriorityTasks }}</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="h-full flex items-end">
                                <div class="bg-yellow-500 w-12 rounded-t-lg"
                                    style="height: {{ ($mediumPriorityTasks / max($totalTasks, 1)) * 100 }}%"></div>
                            </div>
                            <span class="text-xs mt-2 text-gray-600">Sedang</span>
                            <span class="text-sm font-medium">{{ $mediumPriorityTasks }}</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="h-full flex items-end">
                                <div class="bg-blue-500 w-12 rounded-t-lg"
                                    style="height: {{ ($lowPriorityTasks / max($totalTasks, 1)) * 100 }}%"></div>
                            </div>
                            <span class="text-xs mt-2 text-gray-600">Rendah</span>
                            <span class="text-sm font-medium">{{ $lowPriorityTasks }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Kategori dengan tugas terbanyak:</span>
                        <span class="font-medium">{{ $topCategory ?? 'Tidak ada' }}</span>
                    </div>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Deadline Mendatang</h2>

                @if (count($upcomingDeadlineTasks) > 0)
                    <div class="space-y-3">
                        @foreach ($upcomingDeadlineTasks as $task)
                            <div
                                class="flex items-center gap-3 p-3 rounded-lg {{ \Carbon\Carbon::parse($task->deadline)->isPast() ? 'bg-red-50' : 'bg-yellow-50' }}">
                                <div
                                    class="w-10 h-10 flex-shrink-0 rounded-full {{ \Carbon\Carbon::parse($task->deadline)->isPast() ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600' }} flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-800 truncate">{{ $task->title }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($task->deadline)->isPast()
                                            ? 'Terlambat ' . \Carbon\Carbon::parse($task->deadline)->diffForHumans()
                                            : 'Dalam ' . \Carbon\Carbon::parse($task->deadline)->diffForHumans() }}
                                    </p>
                                </div>
                                <a href="/tasks/{{ $task->id }}" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500">Tidak ada deadline dalam waktu dekat</p>
                    </div>
                @endif
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarGrid = document.getElementById('calendar-grid');
                const currentMonthDisplay = document.getElementById('current-month-display');
                const prevMonthBtn = document.getElementById('prev-month');
                const nextMonthBtn = document.getElementById('next-month');
                const highPriorityCount = document.getElementById('high-priority-count');
                const mediumPriorityCount = document.getElementById('medium-priority-count');
                const lowPriorityCount = document.getElementById('low-priority-count');
                const taskModal = document.getElementById('task-modal');
                const modalTitle = document.getElementById('modal-title');
                const modalContent = document.getElementById('modal-content');
                const closeModal = document.getElementById('close-modal');
                const modalCloseBtn = document.getElementById('modal-close-btn');


                let currentDate = new Date();
                let currentMonth = currentDate.getMonth();
                let currentYear = currentDate.getFullYear();

                // Data tugas dari controller PHP
                const calendarEvents = @json($calendarEvents);

                // Fungsi untuk mengorganisir tugas berdasarkan tanggal
                function organizeTasksByDate(events) {
                    const tasksByDate = {};

                    events.forEach(event => {
                        const dateKey = event.start; // format: YYYY-MM-DD

                        if (!tasksByDate[dateKey]) {
                            tasksByDate[dateKey] = [];
                        }

                        // Konversi dari format calendar event ke format yang digunakan script
                        tasksByDate[dateKey].push({
                            id: event.id,
                            title: event.title,
                            priority: event.extendedProps.priority,
                            status: event.extendedProps.status,
                            date: event.start
                        });
                    });

                    return tasksByDate;
                }

                // Menyiapkan data tugas
                const tasks = organizeTasksByDate(calendarEvents);

                // Function to update priority counts
                function updatePriorityCounts(month, year) {
                    let highCount = 0;
                    let mediumCount = 0;
                    let lowCount = 0;

                    // Loop through all days in the month
                    const daysInMonth = new Date(year, month + 1, 0).getDate();

                    for (let day = 1; day <= daysInMonth; day++) {
                        const dateString =
                            `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                        const dayTasks = tasks[dateString] || [];

                        // Count tasks by priority
                        dayTasks.forEach(task => {
                            if (task.priority === 'high') highCount++;
                            else if (task.priority === 'medium') mediumCount++;
                            else if (task.priority === 'low') lowCount++;
                        });
                    }

                    // Update the counters
                    highPriorityCount.textContent = highCount;
                    mediumPriorityCount.textContent = mediumCount;
                    lowPriorityCount.textContent = lowCount;
                }

                function showTaskDetails(date, tasks) {
                    // Set modal title
                    const modalTitle = document.getElementById('modal-title');
                    modalTitle.textContent = `Tugas Tanggal ${date}`;

                    // Ambil elemen tombol "Lihat Kalender"
                    const viewDateBtn = document.getElementById('view-date-btn');

                    // Format tanggal menjadi dd-MM-yyyy
                    const formattedDate = date.split('/').reverse().join(
                    '-'); // Mengubah format tanggal menjadi dd-MM-yyyy

                    // Set URL href dengan format yang benar
                    viewDateBtn.href = `/tasks/date/${formattedDate}`; // Format URL sesuai yang diinginkan

                    // Clear previous content
                    const modalContent = document.getElementById('modal-content');
                    modalContent.innerHTML = '';

                    if (tasks.length === 0) {
                        modalContent.innerHTML =
                            '<p class="text-center text-gray-500">Tidak ada tugas untuk tanggal ini.</p>';
                    } else {
                        // Create task list
                        const taskList = document.createElement('ul');
                        taskList.className = 'space-y-2';

                        tasks.forEach(task => {
                            const taskItem = document.createElement('li');
                            taskItem.className =
                            'bg-gray-50 rounded-md p-3 cursor-pointer'; // Added cursor-pointer

                            // Click event listener to navigate to task details
                            taskItem.addEventListener('click', function() {
                                window.location.href = `/tasks/${task.id}`;
                            });

                            const taskHeader = document.createElement('div');
                            taskHeader.className = 'flex justify-between items-start';

                            const taskTitle = document.createElement('h5');
                            taskTitle.className = 'font-medium text-gray-900';
                            taskTitle.textContent = task.title;

                            const priorityBadge = document.createElement('span');
                            priorityBadge.className =
                                `text-xs px-2 py-1 rounded-full ${getPriorityBadgeClass(task.priority)}`;
                            priorityBadge.textContent = task.priority === 'high' ? 'Tinggi' :
                                task.priority === 'medium' ? 'Sedang' : 'Rendah';

                            taskHeader.appendChild(taskTitle);
                            taskHeader.appendChild(priorityBadge);
                            taskItem.appendChild(taskHeader);

                            taskList.appendChild(taskItem);
                        });

                        modalContent.appendChild(taskList);
                    }

                    // Show modal
                    const taskModal = document.getElementById('task-modal');
                    taskModal.classList.remove('hidden');
                }

                // Function to get the appropriate badge class based on priority
                function getPriorityBadgeClass(priority) {
                    if (priority === 'high') {
                        return 'bg-red-500 text-white'; // High priority
                    } else if (priority === 'medium') {
                        return 'bg-yellow-500 text-white'; // Medium priority
                    } else {
                        return 'bg-green-500 text-white'; // Low priority
                    }
                }





                // Function to render the calendar
                function renderCalendar(month, year) {
                    calendarGrid.innerHTML = '';

                    // Set month and year in the header
                    const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    currentMonthDisplay.textContent = `${monthNames[month]} ${year}`;

                    // Get first day of month and total days in month
                    const firstDay = new Date(year, month, 1).getDay();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();

                    // Add empty cells for days before the first day of the month
                    for (let i = 0; i < firstDay; i++) {
                        const emptyDay = document.createElement('div');
                        emptyDay.className = 'h-16 border border-gray-100 rounded-md bg-gray-50';
                        calendarGrid.appendChild(emptyDay);
                    }

                    // Add cells for all days in the month
                    for (let day = 1; day <= daysInMonth; day++) {
                        const dayCell = document.createElement('div');
                        dayCell.className = 'min-h-16 border border-gray-200 rounded-md relative p-1';

                        // Check if the current date is today
                        const isToday = day === currentDate.getDate() &&
                            month === currentDate.getMonth() &&
                            year === currentDate.getFullYear();

                        // Format the date string to check for tasks
                        const dateString =
                            `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                        const dayTasks = tasks[dateString] || [];

                        // Count tasks by priority for this day
                        const highCount = dayTasks.filter(task => task.priority === 'high').length;
                        const mediumCount = dayTasks.filter(task => task.priority === 'medium').length;
                        const lowCount = dayTasks.filter(task => task.priority === 'low').length;

                        // Determine cell color based on tasks priority
                        let cellClass = 'bg-white';
                        if (dayTasks.length > 0) {
                            if (highCount > 0) {
                                cellClass = 'bg-rose-50 border-rose-200';
                            } else if (mediumCount > 0) {
                                cellClass = 'bg-amber-50 border-amber-200';
                            } else if (lowCount > 0) {
                                cellClass = 'bg-emerald-50 border-emerald-200';
                            }
                        }

                        // Add today highlight
                        if (isToday) {
                            dayCell.className += ' ring-2 ring-blue-400';
                        }

                        dayCell.className += ` ${cellClass}`;

                        // Create day number element
                        const dayNumber = document.createElement('div');
                        dayNumber.className = `text-sm font-medium p-1 ${isToday ? 'text-blue-600' : 'text-gray-700'}`;
                        dayNumber.textContent = day;
                        dayCell.appendChild(dayNumber);

                        // Add task indicators if there are tasks
                        if (dayTasks.length > 0) {
                            const taskIndicator = document.createElement('div');
                            taskIndicator.className = 'absolute bottom-1 right-1 flex items-center justify-center';

                            const taskCount = document.createElement('span');
                            taskCount.className = 'text-xs px-1.5 py-0.5 rounded-full bg-gray-800 text-white';
                            taskCount.textContent = dayTasks.length;
                            taskIndicator.appendChild(taskCount);

                            dayCell.appendChild(taskIndicator);

                            // Add mini priority indicators
                            const priorityIndicators = document.createElement('div');
                            priorityIndicators.className = 'absolute bottom-1 left-1 flex items-center space-x-1';

                            if (highCount > 0) {
                                const highIndicator = document.createElement('div');
                                highIndicator.className = 'w-2 h-2 rounded-full bg-rose-500';
                                priorityIndicators.appendChild(highIndicator);
                            }

                            if (mediumCount > 0) {
                                const mediumIndicator = document.createElement('div');
                                mediumIndicator.className = 'w-2 h-2 rounded-full bg-amber-400';
                                priorityIndicators.appendChild(mediumIndicator);
                            }

                            if (lowCount > 0) {
                                const lowIndicator = document.createElement('div');
                                lowIndicator.className = 'w-2 h-2 rounded-full bg-emerald-500';
                                priorityIndicators.appendChild(lowIndicator);
                            }

                            dayCell.appendChild(priorityIndicators);

                            // Make clickable
                            dayCell.classList.add('cursor-pointer', 'hover:bg-gray-50');
                            dayCell.addEventListener('click', () => {
                                // Show modal with task details
                                showTaskDetails(`${day}/${month + 1}/${year}`, dayTasks);
                            });
                        }

                        calendarGrid.appendChild(dayCell);
                    }

                    // Fill remaining grid with empty cells if needed
                    const totalCells = calendarGrid.childElementCount;
                    const cellsToAdd = 35 - totalCells; // Keep 5 rows (35 cells)
                    if (cellsToAdd > 0) {
                        for (let i = 0; i < cellsToAdd; i++) {
                            const emptyDay = document.createElement('div');
                            emptyDay.className = 'h-16 border border-gray-100 rounded-md bg-gray-50';
                            calendarGrid.appendChild(emptyDay);
                        }
                    }

                    // Update priority counts for the month
                    updatePriorityCounts(month, year);
                }

                // Modal event listeners
                closeModal.addEventListener('click', () => {
                    taskModal.classList.add('hidden');
                });

                modalCloseBtn.addEventListener('click', () => {
                    taskModal.classList.add('hidden');
                });

                // Close modal if clicking outside
                taskModal.addEventListener('click', (e) => {
                    if (e.target === taskModal) {
                        taskModal.classList.add('hidden');
                    }
                });

                // Initial render
                renderCalendar(currentMonth, currentYear);

                // Event listeners for prev/next buttons
                prevMonthBtn.addEventListener('click', () => {
                    currentMonth--;
                    if (currentMonth < 0) {
                        currentMonth = 11;
                        currentYear--;
                    }
                    renderCalendar(currentMonth, currentYear);
                });

                nextMonthBtn.addEventListener('click', () => {
                    currentMonth++;
                    if (currentMonth > 11) {
                        currentMonth = 0;
                        currentYear++;
                    }
                    renderCalendar(currentMonth, currentYear);
                });
            });
        </script>


    @endsection
