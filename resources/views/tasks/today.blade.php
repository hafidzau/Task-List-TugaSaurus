@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">📅 Tugas Hari Ini</h1>

    <!-- Ringkasan Tugas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-blue-500 text-white rounded-lg">
            <h2 class="text-lg">Total Tugas</h2>
            <p class="text-2xl font-bold">{{ $totalTugas }}</p>
        </div>
        <div class="p-4 bg-red-500 text-white rounded-lg">
            <h2 class="text-lg">Belum Selesai</h2>
            <p class="text-2xl font-bold">{{ $belumSelesai }}</p>
        </div>
        <div class="p-4 bg-green-500 text-white rounded-lg">
            <h2 class="text-lg">Selesai</h2>
            <p class="text-2xl font-bold">{{ $selesai }}</p>
        </div>
        <div class="p-4 bg-yellow-500 text-white rounded-lg">
            <h2 class="text-lg">Prioritas Tinggi</h2>
            <p class="text-2xl font-bold">{{ $prioritasTinggi }}</p>
        </div>
    </div>

    <!-- Form Tambah Tugas -->
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex gap-2">
            <input type="text" name="nama" placeholder="Tambahkan tugas..." required
                class="border p-2 rounded w-full">
            <select name="prioritas" class="border p-2 rounded">
                <option value="Tinggi">🔥 Tinggi</option>
                <option value="Sedang">⚡ Sedang</option>
                <option value="Rendah">✅ Rendah</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
        </div>
    </form>

    <!-- Daftar Tugas Hari Ini -->
    <div class="bg-white shadow-lg rounded-lg p-4">
        <h2 class="text-xl font-bold mb-4">📝 Daftar Tugas</h2>
        <ul>
            @foreach ($tasks as $task)
            <li class="flex justify-between items-center p-3 border-b">
                <div>
                    <p class="text-lg font-semibold">{{ $task->nama }}</p>
                    <p class="text-sm text-gray-500">{{ $task->prioritas }}</p>
                </div>
                <div class="flex gap-2">
                    <!-- Tombol Tandai Selesai -->
                    @if (!$task->selesai)
                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">✅</button>
                    </form>
                    @endif
                    <!-- Tombol Edit -->
                    <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️</a>
                    <!-- Tombol Hapus -->
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">🗑️</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
