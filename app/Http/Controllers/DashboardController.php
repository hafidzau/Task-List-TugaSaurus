<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Ambil semua tugas hari ini
        $todayTasks = Task::where('user_id', Auth::id())
            ->whereDate('deadline', $today)
            ->orderBy('deadline')
            ->get();

        // Ambil tugas mendatang (setelah hari ini)
        $futureTasks = Task::where('user_id', Auth::id())
            ->whereDate('deadline', '>', $today)
            ->orderBy('deadline')
            ->get();

        $missedTasks = Task::where('deadline', '<', $today)->orderByDesc('deadline')->get();

        // Tugas hari ini yang sudah selesai
        $todayCompletedTasks = $todayTasks->where('status', 'completed');

        // Tugas hari ini yang belum selesai
        $todayPendingTasks = $todayTasks->where('status', '!=', 'completed');

        $recentTasks = $todayPendingTasks->merge($todayCompletedTasks);


        // Hitung statistik umum
        $totalTasks = Task::where('user_id', Auth::id())->count();
        $completedTasks = Task::where('user_id', Auth::id())->where('status', 'completed')->count();
        $pendingTasks = $totalTasks - $completedTasks;
        $highPriorityTasks = Task::where('user_id', Auth::id())->where('priority', 'high')->count();

        // Hitung progress hari ini
        $todayTasksCount = $todayTasks->count();
        $todayCompletedCount = $todayCompletedTasks->count();
        $todayProgress = $todayTasksCount > 0 ? round(($todayCompletedCount / $todayTasksCount) * 100) : 0;

        // Hitung progress tugas mendatang
        $futureTasksCount = $futureTasks->count();
        $futureCompletedCount = $futureTasks->where('status', 'completed')->count();
        $futureProgress = $futureTasksCount > 0 ? round(($futureCompletedCount / $futureTasksCount) * 100) : 0;

        return view('dashboard', compact(
            'todayPendingTasks',
            'todayCompletedTasks',
            'futureTasks',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'highPriorityTasks',
            'todayProgress',
            'futureProgress',
            'todayTasksCount',
            'todayCompletedCount',
            'recentTasks',
            'missedTasks'
        ));
    }
}
