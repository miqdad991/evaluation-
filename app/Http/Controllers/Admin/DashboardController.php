<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PositionKPI;
use App\Models\Sprint;
use App\Models\Task;
use App\Models\TaskKpiReview;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sprintId = $request->sprint_id;
        $dateFrom = $request->date_from ?? now()->startOfMonth()->toDateString();
        $dateTo = $request->date_to ?? now()->toDateString();

        $users = User::with(['tasks' => function ($query) use ($sprintId, $dateFrom, $dateTo) {
            $query->where('status', 'approved');
            if ($sprintId) {
                $query->where('sprint_id', $sprintId);
            } else {
                $query->whereBetween('task_date', [$dateFrom, $dateTo]);
            }
        }])->paginate(15);

        $sprints = Sprint::all(); // For the dropdown filter

        return view('admin.dashboard', compact('users', 'sprints', 'sprintId', 'dateFrom', 'dateTo'));
    }
    /**
     * Display a listing of the resource.
     */
    public function userTasks(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $sprintId = $request->sprint_id;
        $dateFrom = $request->date_from ?? now()->startOfMonth()->toDateString();
        $dateTo = $request->date_to ?? now()->toDateString();

        $tasks = Task::where('user_id', $user->id)
            //->whereBetween('task_date', [$dateFrom, $dateTo])
            ->when($sprintId, fn($q) => $q->where('sprint_id', $sprintId))
            ->orderBy('task_date', 'desc')
            ->get();

        return view('admin.user_tasks', compact('user', 'tasks', 'dateFrom', 'dateTo', 'sprintId'));
    }
}
