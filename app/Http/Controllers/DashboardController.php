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
    
        // Ambil tugas hari ini
        $recentTasks = Task::where('user_id', Auth::id())
            ->whereDate('deadline', $today)
            ->orderBy('deadline')
            ->limit(5)
            ->get();
    
        // Ambil tugas mendatang (setelah hari ini)
        $futureTasks = Task::where('user_id', Auth::id())
            ->whereDate('deadline', '>', $today)
            ->orderBy('deadline')
            ->limit(5)
            ->get();
    
        // Hitung statistik
        $totalTasks = Task::where('user_id', Auth::id())->count();
        $completedTasks = Task::where('user_id', Auth::id())->where('status', 'completed')->count();
        $pendingTasks = $totalTasks - $completedTasks; 
        $highPriorityTasks = Task::where('user_id', Auth::id())->where('priority', 'high')->count();
    
        // Hitung progress hari ini
        $todayTasksCount = $recentTasks->count();
        $todayCompletedTasks = $recentTasks->where('status', 'completed')->count();
        $todayProgress = $todayTasksCount > 0 ? round(($todayCompletedTasks / $todayTasksCount) * 100) : 0;
    
        // Hitung progress tugas mendatang
        $futureTasksCount = $futureTasks->count();
        $futureCompletedTasks = $futureTasks->where('status', 'completed')->count();
        $futureProgress = $futureTasksCount > 0 ? round(($futureCompletedTasks / $futureTasksCount) * 100) : 0;
    
        return view('dashboard', compact(
            'recentTasks', 
            'futureTasks', 
            'totalTasks', 
            'completedTasks', 
            'pendingTasks', 
            'highPriorityTasks', 
            'todayProgress', 
            'futureProgress',
            'todayCompletedTasks',
            'todayTasksCount'
        ));
    }
}
