@extends('layout')

@section('content')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const datePicker = document.getElementById('datePicker');
            const filterForm = document.getElementById('filterForm');
            const priorityFilter = document.getElementById('priorityFilter');
            const statusFilter = document.getElementById('statusFilter');

            datePicker?.addEventListener('change', function() {
                const date = this.value;
                const priority = priorityFilter?.value ?? '';
                const status = statusFilter?.value ?? '';
                window.location.href = `/tasks/date/${date}?priority=${priority}&status=${status}`;
            });

            filterForm?.addEventListener('change', function() {
                const date = datePicker?.value;
                const priority = priorityFilter?.value;
                const status = statusFilter?.value;
                window.location.href = `/tasks/date/${date}?priority=${priority}&status=${status}`;
            });
        });
    </script>


    <div class="p-4 space-y-4">

        <div>
            <label for="datePicker" class="block text-gray-700 font-medium">Pilih Tanggal:</label>
            <input type="date" id="datePicker" name="date" value="{{ $date }}"
                class="w-full p-2 border rounded-lg mt-1">
        </div>

        <form id="filterForm" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="priorityFilter" class="block text-gray-700 font-medium">Filter Prioritas:</label>
                <select id="priorityFilter" name="priority" class="w-full p-2 border rounded-lg">
                    <option value="">Semua</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Rendah</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="statusFilter" class="block text-gray-700 font-medium">Filter Status:</label>
                <select id="statusFilter" name="status" class="w-full p-2 border rounded-lg">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Belum Selesai</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </form>

        @php
            $totalTugas = $tasks->count();
            $selesai = $tasks->where('status', 'completed')->count();
            $progress = $totalTugas > 0 ? ($selesai / $totalTugas) * 100 : 0;
        @endphp

        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $progress }}%;"></div>
        </div>

        @if ($tasks->isEmpty())
            <div class="flex flex-col items-center justify-center py-8 text-gray-500">
                <p class="text-lg">Tidak ada tugas yang sesuai filter pada tanggal ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($tasks as $task)
                    <x-task.list :task="$task" />
                @endforeach
            </div>
        @endif

        <button onclick="openModal('url')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Tambah Tugas
        </button>

        @include('components.add.modal')

    </div>

@endsection
