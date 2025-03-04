@extends('layout')

@section('content')
<h2 class="text-xl font-bold mb-4">📅 Tugas untuk {{ $tanggal }}</h2>

<!-- Form Tambah Tugas -->
<form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
    @csrf
    <input type="hidden" name="deadline" value="{{ $tanggal }}">
    <div class="flex gap-2">
        <input type="text" name="nama" placeholder="Nama tugas..." required class="border p-2 rounded w-full">
        <select name="prioritas" class="border p-2 rounded">
            <option value="Tinggi">🔥 Tinggi</option>
            <option value="Sedang">⚡ Sedang</option>
            <option value="Rendah">✅ Rendah</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
    </div>
</form>

<!-- Daftar Tugas -->
@foreach ($tasks as $task)
<div class="bg-white p-4 shadow rounded flex items-center justify-between mt-2">
    <div>
        <h3 class="text-lg font-bold">{{ $task->nama }}</h3>
        <p class="text-sm text-gray-500">🔥 Prioritas: {{ $task->prioritas }}</p>
    </div>
    <div class="flex gap-2">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="selesai" value="{{ $task->selesai ? 0 : 1 }}">
            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">
                ✅ {{ $task->selesai ? 'Batal Selesai' : 'Tandai Selesai' }}
            </button>
        </form>
        <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️ Edit</a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endforeach

@endsection
