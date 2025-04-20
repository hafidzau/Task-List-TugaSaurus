@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="flex items-center text-green-600 hover:text-green-700">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $task->title }}</h1>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-sm {{ $task->priority === 'high' ? 'bg-red-100 text-red-700' : ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
                        {{ ucfirst($task->priority) }} Priority
                    </span>
                    <span class="px-3 py-1 rounded-full text-sm {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="/tasks/{{ $task->id }}/edit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Edit
                </a>
                <form action="/tasks/{{ $task->id }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Tugas</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Deadline</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</p>
                    </div>
                    @if($task->time_start)
                    <div>
                        <p class="text-sm text-gray-500">Waktu Mulai</p>
                        <p class="font-medium">{{ $task->time_start }}</p>
                    </div>
                    @endif
                    @if($task->time_end)
                    <div>
                        <p class="text-sm text-gray-500">Waktu Selesai</p>
                        <p class="font-medium">{{ $task->time_end }}</p>
                    </div>
                    @endif
                    @if($task->start_date)
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Mulai</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($task->start_date)->format('d M Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    @if($task->description)
                        <p class="text-gray-700 whitespace-pre-line">{{ $task->description }}</p>
                    @else
                        <p class="text-gray-500 italic">Tidak ada deskripsi</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Dibuat pada</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($task->created_at)->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terakhir diperbarui</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($task->updated_at)->format('d M Y, H:i') }}</p>
                </div>
                <form action="/tasks/toggle-status/{{ $task->id }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-md {{ $task->status === 'completed' ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white">
                        {{ $task->status === 'completed' ? 'Tandai Belum Selesai' : 'Tandai Selesai' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection