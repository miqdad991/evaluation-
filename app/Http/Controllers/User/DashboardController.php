<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PositionKpi;
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
        $user = auth()->user();

        // Determine current or selected sprint
        if ($request->sprint_id) {
            $sprintId = $request->sprint_id;
        } else {
            $sprint = \App\Models\Sprint::latest('created_at')->first();
            $sprintId = $sprint?->id; // Safe null handling
        }

        // Get all sprints for dropdown/filtering
        $sprints = \App\Models\Sprint::all();

        // User's tasks for selected sprint
        $taskQuery = $user->tasks()->where('sprint_id', $sprintId);

        // Total number of tasks
        $taskCount = $taskQuery->count();

        // 🎯 Average score for those tasks
        $score = $taskQuery->avg('average_score');
        $tasks = $taskQuery->get();
        return view('dashboard', compact('taskCount', 'sprints', 'score', 'sprintId', 'tasks'));
    }

    public function newTask() {
        die('xxx');
    }

}
