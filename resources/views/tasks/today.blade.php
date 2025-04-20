@extends('layout')

@section('content')

    <script>
        document.getElementById('dropdownUserButton')?.addEventListener('click', function() {
            document.getElementById('dropdownUser')?.classList.toggle('hidden');
        });
    </script>

<div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg shadow-sm">
    <div class="relative flex items-center">
        <!-- Ikon pencarian di sebelah kiri -->
        <div class="absolute left-3 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        
        <!-- Input pencarian dengan padding kiri yang diperbesar untuk ruang ikon -->
        <input 
            type="text" 
            id="search" 
            placeholder="Cari tugas..." 
            class="w-full p-3 pl-10 border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:shadow-md"
        >
        
        <!-- Tombol hapus yang muncul saat ada teks (bisa ditambahkan fungsi JavaScript) -->
        <div class="absolute right-3 hidden text-gray-400 hover:text-gray-600 cursor-pointer" id="clearSearch">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
    
    <!-- Teks kecil di bawah input sebagai bantuan -->
    <div class="text-xs text-gray-500 mt-2 ml-2">
        Ketik untuk mencari berdasarkan judul, tag, atau prioritas
    </div>
</div>

    <div class="p-4">
        @php
            $progress = $totalTugas > 0 ? ($selesai / $totalTugas) * 100 : 0;
        @endphp
        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
            <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $progress }}%;"></div>
        </div>
    </div>


    <div class="p-4">
        @if ($recentTasks->isEmpty())
            <div class="flex flex-col items-center justify-center py-8 text-gray-500">
                <p class="text-lg">Belum ada tugas untuk hari ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($recentTasks->take(3) as $task)
                    <div class="task-item" data-title="{{ strtolower($task->title) }}">
                        <x-task.list :task="$task" />
                    </div>
                @endforeach

            </div>
        @endif

    </div>

    <div class="p-4 flex justify-end">
        <button onclick="openModal('today')" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
            Tambah Tugas
        </button>
    </div>


    @include('components.add.modal')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const tasks = document.querySelectorAll('.task-item');
    
            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase();
    
                tasks.forEach(task => {
                    const title = task.getAttribute('data-title');
                    if (title.includes(query)) {
                        task.style.display = '';
                    } else {
                        task.style.display = 'none';
                    }
                });
            });
        });
    </script>
    

@endsection
