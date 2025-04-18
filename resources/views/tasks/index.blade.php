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
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Tugas</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalTasks }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Tasks Card -->
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Tugas Selesai</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $completedTasks }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-lg text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Tugas Pending</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $pendingTasks }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            @if($upcomingDeadlines > 0)
            <div class="mt-2 text-sm text-red-500">
                {{ $upcomingDeadlines }} deadline dalam 48 jam
            </div>
            @endif
        </div>

        <!-- High Priority Tasks Card -->
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Prioritas Tinggi</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $highPriorityTasks }}</h3>
                </div>
                <div class="bg-red-100 p-3 rounded-lg text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
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
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Tugas Terbaru</h2>
                <a href="/tasks" class="text-sm text-green-600 hover:text-green-700 flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            @if(count($recentTasks) > 0)
            <div class="space-y-3">
                @foreach($recentTasks as $task)
                <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-all duration-150 border {{ $task->status === 'completed' ? 'border-green-200' : ($task->priority === 'high' ? 'border-red-200' : ($task->priority === 'medium' ? 'border-yellow-200' : 'border-gray-200')) }}">
                    <form action="/tasks/toggle-status/{{ $task->id }}" method="POST" class="mr-3">
                        @csrf
                        <button type="submit" class="flex items-center justify-center">
                            <div class="w-5 h-5 rounded-full border {{ $task->status === 'completed' ? 'bg-green-500 border-green-500' : 'border-gray-300' }} flex items-center justify-center">
                                @if($task->status === 'completed')
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                                @endif
                            </div>
                        </button>
                    </form>
                    
                    <div class="flex-1">
                        <a href="/tasks/{{ $task->id }}" class="block">
                            <div class="flex flex-col">
                                <span class="{{ $task->status === 'completed' ? 'line-through text-gray-500' : 'text-gray-800' }} font-medium">
                                    {{ $task->title }}
                                </span>
                                <div class="flex items-center mt-1 text-xs">
                                    <span class="flex items-center text-gray-500">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                    </span>
                                    @if($task->priority)
                                    <span class="ml-3 px-2 py-0.5 rounded-full text-xs
                                        {{ $task->priority === 'high' ? 'bg-red-100 text-red-700' : 
                                          ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' : 
                                          'bg-blue-100 text-blue-700') }}">
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
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-gray-500">Belum ada tugas terbaru</p>
                <a href="/tasks/create" class="mt-3 inline-block text-sm text-green-600 hover:text-green-700">+ Tambah Tugas Baru</a>
            </div>
            @endif
        </div>

        <!-- Integrated Calendar Section -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Kalender Tugas</h2>
                <div class="flex gap-2">
                    <button id="prev-month" class="p-1 rounded-lg hover:bg-gray-100 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button id="next-month" class="p-1 rounded-lg hover:bg-gray-100 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="calendar" class="fc-theme-standard" style="height: 350px;"></div>
        </div>
    </div>

    <!-- Task Progress and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
        <!-- Task Completion Progress -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Progress Keseluruhan</h2>
            <div class="flex justify-center mb-4">
                <div class="w-40 h-40 relative">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" stroke="currentColor" 
                                stroke-width="8" fill="none" 
                                class="text-gray-200"/>
                        <circle cx="50" cy="50" r="45" stroke="currentColor"
                                stroke-width="8" fill="none"
                                stroke-dasharray="{{ $progress * 2.83 }}, 283"
                                class="text-green-600 transition-all duration-1000"/>
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
                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($weeklyCompleted / $weeklyTarget) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Task Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Tugas</h2>
            <div class="flex items-center justify-center h-40">
                <div class="w-full flex items-end justify-around h-32">
                    <div class="flex flex-col items-center">
                        <div class="h-full flex items-end">
                            <div class="bg-red-500 w-12 rounded-t-lg" style="height: {{ ($highPriorityTasks / max($totalTasks, 1)) * 100 }}%"></div>
                        </div>
                        <span class="text-xs mt-2 text-gray-600">Tinggi</span>
                        <span class="text-sm font-medium">{{ $highPriorityTasks }}</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="h-full flex items-end">
                            <div class="bg-yellow-500 w-12 rounded-t-lg" style="height: {{ ($mediumPriorityTasks / max($totalTasks, 1)) * 100 }}%"></div>
                        </div>
                        <span class="text-xs mt-2 text-gray-600">Sedang</span>
                        <span class="text-sm font-medium">{{ $mediumPriorityTasks }}</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="h-full flex items-end">
                            <div class="bg-blue-500 w-12 rounded-t-lg" style="height: {{ ($lowPriorityTasks / max($totalTasks, 1)) * 100 }}%"></div>
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
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Deadline Mendatang</h2>
            
            @if(count($upcomingDeadlineTasks) > 0)
            <div class="space-y-3">
                @foreach($upcomingDeadlineTasks as $task)
                <div class="flex items-center gap-3 p-3 rounded-lg {{ \Carbon\Carbon::parse($task->deadline)->isPast() ? 'bg-red-50' : 'bg-yellow-50' }}">
                    <div class="w-10 h-10 flex-shrink-0 rounded-full {{ \Carbon\Carbon::parse($task->deadline)->isPast() ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600' }} flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500">Tidak ada deadline dalam waktu dekat</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions Floating Button -->
    <div class="fixed bottom-8 right-8 z-10">
        <div class="relative group">
            <button class="bg-green-600 hover:bg-green-700 text-white p-4 rounded-full shadow-lg flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </button>
            <div class="absolute right-0 bottom-16 hidden group-hover:block animate-fade-in">
                <div class="flex flex-col items-end space-y-2">
                    <a href="/tasks/create" class="bg-white text-gray-700 py-2 px-4 rounded-lg shadow-md flex items-center gap-2 text-sm whitespace-nowrap hover:bg-gray-50">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Tugas Baru
                    </a>
                    <a href="/reports" class="bg-white text-gray-700 py-2 px-4 rounded-lg shadow-md flex items-center gap-2 text-sm whitespace-nowrap hover:bg-gray-50">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },
            buttonText: {
                today: 'Hari ini'
            },
            events: @json($calendarEvents),
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            eventClick: function(info) {
                window.location.href = '/tasks/' + info.event.id;
            },
            eventClassNames: function(arg) {
                if (arg.event.extendedProps.priority === 'high') {
                    return ['bg-red-500', 'border-red-600'];
                } else if (arg.event.extendedProps.priority === 'medium') {
                    return ['bg-yellow-500', 'border-yellow-600'];
                } else {
                    return ['bg-blue-500', 'border-blue-600'];
                }
            },
            dayMaxEvents: true,
            eventContent: function(arg) {
                return {
                    html: '<div class="text-xs truncate px-1 py-0.5">' + arg.event.title + '</div>'
                };
            }
        });
        
        calendar.render();
        
        // Handle month navigation
        document.getElementById('prev-month').addEventListener('click', function() {
            calendar.prev();
        });
        
        document.getElementById('next-month').addEventListener('click', function() {
            calendar.next();
        });
        
        // Add tooltip for tasks with details
        const taskElements = document.querySelectorAll('[data-task-id]');
        taskElements.forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const taskId = this.getAttribute('data-task-id');
                // You can implement a tooltip here if needed
            });
        });
        
        // Animation for progress bars
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const targetWidth = bar.getAttribute('data-progress') + '%';
            setTimeout(() => {
                bar.style.width = targetWidth;
            }, 300);
        });
    });
</script>

<style>
    .fc-event {
        cursor: pointer;
        border: none !important;
    }
    .fc-day-today {
        background-color: rgba(74, 222, 128, 0.1) !important;
    }
    .fc-header-toolbar {
        margin-bottom: 0.5em !important;
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
@endsection