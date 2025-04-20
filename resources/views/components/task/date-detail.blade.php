<!-- resources/views/tasks/date-detail.blade.php -->
<h2 class="text-lg font-semibold mb-4">Tugas Tanggal {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h2>

@foreach (['high' => 'Tinggi', 'medium' => 'Sedang', 'low' => 'Rendah'] as $level => $label)
    @if($grouped[$level]->count())
        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Prioritas {{ $label }}</h3>
            <ul class="space-y-2">
                @foreach($grouped[$level] as $task)
                    <li class="bg-gray-50 rounded-md p-3">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-900">{{ $task->title }}</h4>
                            <span class="text-xs px-2 py-1 rounded-full
                                @if($level === 'high') bg-rose-100 text-rose-800
                                @elseif($level === 'medium') bg-amber-100 text-amber-800
                                @else bg-emerald-100 text-emerald-800 @endif">
                                {{ $label }}
                            </span>
                        </div>
                        <div class="mt-2 text-xs text-gray-500">
                            Status: <span class="font-medium text-gray-700">{{ $task->status }}</span>
                        </div>
                        <a href="{{ route('tasks.show', $task->id) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-2 block">Lihat Detail</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endforeach

@if ($grouped['high']->isEmpty() && $grouped['medium']->isEmpty() && $grouped['low']->isEmpty())
    <p class="text-center text-gray-500">Tidak ada tugas untuk tanggal ini.</p>
@endif
