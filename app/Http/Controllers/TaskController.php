<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('deadline', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // 🔹 Menampilkan tugas untuk hari ini
    public function today()
    {
        $tasks = Task::where('user_id', Auth::id())
                    ->whereDate('deadline', now())
                    ->get();

        return view('tasks.today', [
            'tasks' => $tasks,
            'totalTugas' => $tasks->count(),
            'belumSelesai' => $tasks->where('status', 'pending')->count(),
            'selesai' => $tasks->where('status', 'completed')->count(),
            'prioritasTinggi' => $tasks->where('priority', 'high')->count(),
        ]);
    }

    // 🔹 Method untuk mendapatkan warna berdasarkan prioritas
    private function getPriorityColor($priority)
    {
        return match (strtolower($priority)) {
            'high' => 'bg-red-500 text-white',
            'medium' => 'bg-yellow-500 text-black',
            'low' => 'bg-green-500 text-white',
            default => 'bg-gray-500 text-white',
        };
    }

    // 🔹 Menampilkan semua tugas dengan kalender besar
    public function tasks()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        // Get recent tasks
        $recentTasks = Task::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Task statistics
        $totalTasks = Task::where('user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'completed')->count();
        $pendingTasks = $totalTasks - $completedTasks;

        // Priority statistics
        $highPriorityTasks = Task::where('user_id', $user->id)->where('priority', 'high')->count();
        $mediumPriorityTasks = Task::where('user_id', $user->id)->where('priority', 'medium')->count();
        $lowPriorityTasks = Task::where('user_id', $user->id)->where('priority', 'low')->count();

        // Overall progress
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Monthly progress
        $monthlyTasks = Task::where('user_id', $user->id)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();
        $monthlyCompleted = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->count();
        $monthlyProgress = $monthlyTasks > 0 ? round(($monthlyCompleted / $monthlyTasks) * 100) : 0;
        

        // Weekly completion
        $weeklyTarget = 10;
        $weeklyCompleted = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$weekStart, $weekEnd])
            ->count();

        // Upcoming deadlines
        $upcomingDeadlines = Task::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->whereDate('deadline', '>=', $today)
            ->whereDate('deadline', '<=', $today->copy()->addDays(2))
            ->count();

        // Upcoming deadline tasks
        $upcomingDeadlineTasks = Task::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->whereDate('deadline', '>=', $today)
            ->whereDate('deadline', '<=', $today->copy()->addDays(7))
            ->orderBy('deadline')
            ->take(5)
            ->get();

        // Calendar events
        $calendarEvents = Task::where('user_id', $user->id)
            ->whereDate('deadline', '>=', $today->copy()->subDays(30))
            ->whereDate('deadline', '<=', $today->copy()->addDays(60))
            ->get()
            ->map(function($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'start' => Carbon::parse($task->deadline)->format('Y-m-d'),
                    'color' => $this->getPriorityColor($task->priority),
                    'textColor' => '#ffffff',
                    'allDay' => true,
                    'extendedProps' => [
                        'status' => $task->status,
                        'priority' => $task->priority
                    ]
                ];
            });
            
            
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

    // 🔹 Menampilkan tugas berdasarkan tanggal yang dipilih dari kalender
    public function showByDate($tanggal)
    {
        $tasks = Task::where('user_id', Auth::id())
                    ->whereDate('deadline', $tanggal)
                    ->get();

        return view('tasks.date', compact('tasks', 'tanggal'));
    }

    // 🔹 Menyimpan tugas baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'],
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    // 🔹 Menandai tugas sebagai selesai / belum selesai (toggle)
    public function complete($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $task->status = $task->status === 'completed' ? 'pending' : 'completed';
        $task->save();

        return redirect()->back()->with('success', 'Tugas diperbarui!');
    }

    // 🔹 Mengupdate tugas
    public function update(Request $request, $id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($validated);

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui!');
    }

    // 🔹 Menghapus tugas
    public function destroy($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }
}
