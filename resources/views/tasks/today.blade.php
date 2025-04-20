@extends('layout')

@section('content')

    <script>
        document.getElementById('dropdownUserButton')?.addEventListener('click', function() {
            document.getElementById('dropdownUser')?.classList.toggle('hidden');
        });
    </script>

    <div class="p-4">
        <label for="search" class="block text-gray-700 font-medium">Cari Tugas:</label>
        <input type="text" id="search" placeholder="Cari tugas..." class="w-full p-2 border rounded-lg mt-1">
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
                    <x-task.list :task="$task" />
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

@endsection
