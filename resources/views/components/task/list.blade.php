@props(['task'])

@php
    $priorityColors = [
        'low' => 'bg-green-100 border-green-300',
        'medium' => 'bg-yellow-100 border-yellow-300',
        'high' => 'bg-red-100 border-red-300',
    ];
@endphp

<div x-data="{ showModal: false }">
    <!-- Task Card -->
    <div class="relative px-4 py-3 rounded-lg task-card cursor-pointer border-l-4 shadow-md text-base 
        {{ $priorityColors[$task->priority] ?? 'bg-gray-100 border-gray-300' }} 
        {{ $task->completed ? 'bg-green-200' : '' }}"
        @click="showModal = true"
    >
        <div class="flex justify-between items-center gap-4">
            <!-- Form to mark as complete -->
            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline" @click.stop>
                @csrf
                @method('PATCH') <!-- Menggunakan PATCH di sini -->
                <button
                    class="checkbox-custom {{ $task->status === 'completed' ? 'checked' : '' }}"
                    type="submit"
                    aria-label="Mark as completed"
                >
                    <svg class="checkmark" viewBox="0 0 24 24">
                        <path class="checkmark-path" fill="none" stroke="#fff" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </form>

            <!-- Task Title -->
            <span class="flex-1 font-semibold text-gray-800">
                {{ $task->title }}
            </span>

            <!-- Time Center -->
            <div class="text-sm text-gray-700 text-center w-20 font-medium">
                {{ date('H:i', strtotime($task->deadline)) }}
            </div>

            <!-- Date Right -->
            <div class="text-xs text-gray-600 text-right min-w-fit">
                {{ date('d M Y', strtotime($task->deadline)) }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x:task.detail :task="$task" x-show="showModal" @close-modal="showModal = false" />
</div>

<style>
.checkbox-custom {
    width: 24px;
    height: 24px;
    border: 2px solid #d1d5db;
    border-radius: 50%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
}

.checkbox-custom.checked {
    background-color: #10b981;
    border-color: #10b981;
}

.checkmark {
    width: 16px;
    height: 16px;
    opacity: 0;
    transform: scale(0);
    transition: all 0.2s ease;
}

.checkbox-custom.checked .checkmark {
    opacity: 1;
    transform: scale(1);
}

.checkmark-path {
    stroke-dasharray: 29;
    stroke-dashoffset: 29;
    transition: stroke-dashoffset 0.3s ease;
}

.checkbox-custom.checked .checkmark-path {
    stroke-dashoffset: 0;
    animation: checkmark-animation 0.3s ease-in-out forwards;
}

@keyframes checkmark-animation {
    0% {
        stroke-dashoffset: 29;
    }
    100% {
        stroke-dashoffset: 0;
    }
}
</style>
