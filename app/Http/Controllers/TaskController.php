<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class TaskController extends Controller
{
        // 🔹 Menampilkan semua tugas
        public function index()
        {
            $tasks = Task::where('user_id', Auth::id())
                ->orderBy('deadline', 'asc')
                ->get();

            return view('tasks.index', compact('tasks'));
        }

        // 🔹 Menampilkan tugas untuk hari ini
        public function today()
        {
            // Ambil tugas yang deadline-nya hari ini dan urutkan berdasarkan waktu terbaru
            $recentTasks = Task::where('user_id', Auth::id())
                ->whereDate('deadline', now())
                ->latest() // Urutkan berdasarkan waktu terbaru
                ->get();

            return view('tasks.today', [
                'recentTasks' => $recentTasks,
                'totalTugas' => $recentTasks->count(),
                'belumSelesai' => $recentTasks->where('status', 'pending')->count(),
                'selesai' => $recentTasks->where('status', 'completed')->count(),
                'prioritasTinggi' => $recentTasks->where('priority', 'high')->count(),
            ]);
        }



        // 🔹 Menampilkan tugas berdasarkan tanggal dari kalender
        public function showByDate($date)
        {
            $tasks = Task::where('user_id', Auth::id())
                ->whereDate('deadline', $date)
                ->when(request('priority'), function ($query) {
                    $query->where('priority', request('priority'));
                })
                ->when(request('status'), function ($query) {
                    $query->where('status', request('status'));
                })
                ->latest()
                ->get();

            return view('tasks.date', [
                'tasks' => $tasks,
                'date' => $date,
            ]);
        }


        // 🔹 Menyimpan tugas baru
        public function store(Request $request)
        {
            // Tambahkan validasi untuk time_start, time_end, dan start_date
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'required|in:low,medium,high',
                'deadline' => 'required|date',
                'start_date' => 'nullable|date', // Menambahkan validasi untuk start_date
                'time_start' => 'nullable|date_format:H:i', // Menambahkan validasi untuk time_start
                'time_end' => 'nullable|date_format:H:i', // Menambahkan validasi untuk time_end
            ]);

            // Menyimpan data ke database termasuk time_start, time_end, dan start_date
            Task::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'priority' => $validated['priority'],
                'deadline' => $validated['deadline'],
                'start_date' => $validated['start_date'] ?? null, // Jika tidak ada start_date, akan null
                'time_start' => $validated['time_start'] ?? null, // Jika tidak ada time_start, akan null
                'time_end' => $validated['time_end'] ?? null, // Jika tidak ada time_end, akan null
                'status' => 'pending',
            ]);

            return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
        }


        // 🔹 Menandai tugas sebagai selesai/belum selesai
        public function complete($id)
        {
            $task = Task::where('user_id', Auth::id())->findOrFail($id);
            $task->status = $task->status === 'completed' ? 'pending' : 'completed';
            $task->save();

            return redirect()->back()->with('success', 'Status tugas diperbarui!');
        }

        // 🔹 Mengupdate tugas
        public function update(Request $request, $id)
        {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'required|in:low,medium,high',
                'deadline' => 'required|date',
                'time_start' => 'nullable|date_format:H:i',
                'time_end' => 'nullable|date_format:H:i',
                'status' => 'required|in:pending,completed'
            ]);

            $task = Task::findOrFail($id);

            $task->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'priority' => $validated['priority'],
                'deadline' => $validated['deadline'],
                'time_start' => $validated['time_start'] ?? null,
                'time_end' => $validated['time_end'] ?? null,
                'status' => $validated['status']
            ]);

            $redirectUrl = $request->input('redirect') ?? route('tasks.index');

            // Redirect + no cache (opsional untuk browser yang bandel)
            return redirect($redirectUrl)->with([
                'success' => 'Tugas berhasil diperbarui!',
                'cache_buster' => now()->timestamp,
            ]);
        }


        // 🔹 Menampilkan form edit tugas
        public function edit($id)
        {
            $task = Task::where('user_id', Auth::id())->findOrFail($id);
            return view('tasks.edit', compact('task'));
        }


        // 🔹 Menghapus tugas
    public function destroy($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }

    // TaskController.php
    public function showDateDetails($date)
    {
        $tasks = Task::whereDate('due_date', $date)->get();

        $grouped = [
            'high' => $tasks->where('priority', 'high'),
            'medium' => $tasks->where('priority', 'medium'),
            'low' => $tasks->where('priority', 'low'),
        ];

        return view('tasks.date-detail', compact('date', 'grouped'));
    }

    // 🔹 Menampilkan statistik dan kalender tugas
    public function tasks()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $recentTasks = Task::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalTasks = Task::where('user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'completed')->count();
        $pendingTasks = $totalTasks - $completedTasks;

        $highPriorityTasks = Task::where('user_id', $user->id)->where('priority', 'high')->count();
        $mediumPriorityTasks = Task::where('user_id', $user->id)->where('priority', 'medium')->count();
        $lowPriorityTasks = Task::where('user_id', $user->id)->where('priority', 'low')->count();

        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $monthlyTasks = Task::where('user_id', $user->id)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $monthlyCompleted = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->count();

        $monthlyProgress = $monthlyTasks > 0 ? round(($monthlyCompleted / $monthlyTasks) * 100) : 0;

        $weeklyTarget = 10;
        $weeklyCompleted = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$weekStart, $weekEnd])
            ->count();

        $upcomingDeadlines = Task::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->whereDate('deadline', '>=', $today)
            ->whereDate('deadline', '<=', $today->copy()->addDays(2))
            ->count();

        $upcomingDeadlineTasks = Task::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->whereBetween('deadline', [$today, $today->copy()->addDays(7)])
            ->orderBy('deadline')
            ->take(5)
            ->get();

        $calendarEvents = Task::where('user_id', $user->id)
            ->whereBetween('deadline', [$today->copy()->subDays(30), $today->copy()->addDays(60)])
            ->get()
            ->map(fn($task) => [
                'id' => $task->id,
                'title' => $task->title,
                'start' => $task->deadline->format('Y-m-d'),
                'color' => $this->getPriorityColor($task->priority),
                'textColor' => '#ffffff',
                'allDay' => true,
                'extendedProps' => [
                    'status' => $task->status,
                    'priority' => $task->priority,
                ]
            ]);

        

        return view('tasks.index', compact(
            'recentTasks',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'highPriorityTasks',
            'mediumPriorityTasks',
            'lowPriorityTasks',
            'progress',
            'monthlyProgress',
            'weeklyTarget',
            'weeklyCompleted',
            'upcomingDeadlines',
            'upcomingDeadlineTasks',
            'calendarEvents'
        ));
    }

    // 🔹 Helper: Warna label prioritas
    private function getPriorityColor($priority)
    {
        return match (strtolower($priority)) {
            'high' => 'bg-red-500 text-white',
            'medium' => 'bg-yellow-500 text-black',
            'low' => 'bg-green-500 text-white',
            default => 'bg-gray-500 text-white',
        };
    }

    
}
