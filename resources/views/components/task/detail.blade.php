@props(['task'])

<div 
    x-cloak 
    {{ $attributes->merge(['class' => 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50']) }}
>
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-2xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-3xl font-bold text-yellow-600 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a1 1 0 01.894.553l6 12A1 1 0 0116 16H4a1 1 0 01-.894-1.447l6-12A1 1 0 0110 2z" />
                </svg>
                {{ $task->title }}
            </h2>
            <button @click="$dispatch('close-modal')" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Description -->
        <div class="mb-8">
            <p class="text-lg font-semibold text-gray-600 mb-1">Deskripsi</p>
            <p class="text-base">{{ $task->description }}</p>
        </div>

        <!-- Grid Info -->
        <div class="grid grid-cols-2 gap-6 text-lg mb-8">
            <div>
                <p class="text-gray-600 font-semibold mb-1">Tanggal Deadline</p>
                <p>{{ $task->deadline ? date('d M Y', strtotime($task->deadline)) : '-' }}</p>
            </div>
            <div>
                {{-- <p class="text-gray-600 font-semibold mb-1">Waktu Deadline</p>
                <p>
                    {{ ($task->deadline && date('H:i', strtotime($task->deadline)) != '00:00') 
                        ? date('H:i', strtotime($task->deadline)) 
                        : 'Tidak ada jam deadline' }}
                </p> --}}
            </div>
            <div>
                <p class="text-gray-600 font-semibold mb-1">Prioritas</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-bold 
                    {{ match($task->priority) {
                        'urgent' => 'bg-red-100 text-red-600',
                        'high' => 'bg-orange-100 text-orange-600',
                        'medium' => 'bg-yellow-100 text-yellow-600',
                        'low' => 'bg-green-100 text-green-600',
                        default => 'bg-gray-100 text-gray-600'
                    } }}">
                    {{ ucfirst($task->priority) }}
                </span>
            </div>
            <div>
                <p class="text-gray-600 font-semibold mb-1">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-bold 
                    {{ $task->status == 'completed' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                    {{ $task->status == 'completed' ? 'Selesai' : 'Belum Selesai' }}
                </span>

            </div>
        </div>

        <!-- Button -->
        <div class="flex justify-end mt-4">
            <button 
                @click="$wire.call('markAsCompleted', {{ $task->id }})"
                class="px-6 py-3 rounded-lg font-semibold text-white text-lg transition-all duration-200 
                    {{ $task->completed ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700' }}">
                {{ $task->completed ? '✓ Selesai' : 'Tandai Selesai' }}
            </button>
        </div>
    </div>
</div>
