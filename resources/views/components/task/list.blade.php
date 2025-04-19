@props([
    'task',
    'showDescription' => true,
    'showDeadline' => true,
    'redirectUrl' => null,
])

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
        {{ $task->completed ? 'bg-green-200' : '' }}
        hover:shadow-lg transition-all duration-200"
        @click="showModal = true">
        <div class="flex justify-between items-center gap-4">
            <!-- Form to mark as complete -->
            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline" @click.stop>
                @csrf
                @method('PATCH')
                <button class="checkbox-custom {{ $task->status === 'completed' ? 'checked' : '' }}" type="submit"
                    aria-label="Mark as completed">
                    <svg class="checkmark" viewBox="0 0 24 24">
                        <path class="checkmark-path" fill="none" stroke="#fff" stroke-width="3"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </form>

            <!-- Task Content -->
            <div class="flex-1 flex flex-col">
                <!-- Task Title -->
                <span
                    class="font-semibold text-gray-800 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                    {{ $task->title }}
                </span>

                <!-- Task Description Preview (if available) -->
                @if ($task->description)
                    <p class="text-xs text-gray-600 mt-1 line-clamp-1">
                        {{ $task->description }}
                    </p>
                @endif
            </div>

            <!-- Time and Date -->
            <div class="flex flex-col items-end text-right mr-2">
                <div class="text-sm font-medium text-gray-700">
                    {{-- {{ date('H:i', strtotime($task->deadline)) }} --}}
                </div>
                <div class="text-x text-gray-800">
                    {{ date('d M Y', strtotime($task->deadline)) }}
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-1">
                <!-- Edit Task -->
                <a href="{{ route('tasks.edit', $task->id) }}?redirect={{ url()->current() }}" class="p-1.5 rounded-full hover:bg-gray-200 transition"
                    @click.stop="window.location.href = '{{ route('tasks.edit', $task->id) }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>



                <!-- Delete Task -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" @click.stop>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 rounded-full hover:bg-gray-200 transition-colors"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </div>

        </div>

        <!-- Priority Badge -->
        @if ($task->priority)
            <div class="absolute top-0 right-0 transform translate-x-1/4 -translate-y-1/4">
                @php
                    $priorityIcons = [
                        'low' => '<div class="w-4 h-4 rounded-full bg-green-400"></div>',
                        'medium' => '<div class="w-4 h-4 rounded-full bg-yellow-400"></div>',
                        'high' => '<div class="w-4 h-4 rounded-full bg-red-400"></div>',
                    ];
                @endphp
                {!! $priorityIcons[$task->priority] ?? '' !!}
            </div>
        @endif
    </div>

    <!-- Modal -->
    <x:task.detail :task="$task" x-show="showModal" @close-modal="showModal = false" @click.stop />
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
        flex-shrink: 0;
    }

    .checkbox-custom.checked {
        background-color: #10b981;
        border-color: #10b981;
    }

    .checkbox-custom:hover {
        border-color: #10b981;
        transform: scale(1.05);
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

    .task-card {
        transition: all 0.2s ease;
    }

    .task-card:hover {
        transform: translateY(-2px);
    }

    @keyframes checkmark-animation {
        0% {
            stroke-dashoffset: 29;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    /* Line clamp for description */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
