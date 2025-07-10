<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PositionKPI;
use App\Models\Sprint;
use App\Models\Task;
use App\Models\TaskKpiReview;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load 'user' and 'sprint' relationships to avoid N+1 problem
        $tasks = Task::with(['user', 'sprint'])->where('status','approved')
            ->orderBy('id', 'desc')  // You can adjust ordering if needed
            ->paginate(10);          // Adjust pagination count as needed

        return view('admin.tasks.index', compact('tasks'));
    }
    /**
     * Display a listing of the resource.
     */
    public function pendingTasks()
    {
        // Eager load 'user' and 'sprint' relationships to avoid N+1 problem
        $tasks = Task::with(['user', 'sprint'])->where('status','pending')
            ->orderBy('id', 'desc')  // You can adjust ordering if needed
            ->paginate(10);          // Adjust pagination count as needed

        return view('admin.tasks.pending', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $sprints = Sprint::latest()->get();
        $user = User::find($request->user_id);

        $selectedUser = null;
        $positionKPIs = [];

        if ($request->has('user_id')) {
            $selectedUser = User::with('position.kpis')->find($request->user_id);
            if ($selectedUser && $selectedUser->position) {
                $positionKPIs = $selectedUser->position->kpis;
            }
        }

        return view('admin.tasks.create', compact('sprints', 'user', 'selectedUser', 'positionKPIs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sprint_id' => 'required|exists:sprints,id',
            'task_id' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'task_date' => 'nullable|date',
            'kpis' => 'nullable|array',
            'kpis.*.position_kpi_id' => 'required|exists:position_kpis,id',
            'kpis.*.score' => 'required|numeric|min:1|max:10',
        ]);

        // Create the task
        $task = Task::create([
            'sprint_id'   => $validated['sprint_id'],
            'user_id'     => $validated['user_id'],
            'task_id'     => $validated['task_id'],
            'task_date'   => $validated['task_date'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'average_score' => 0, // temp value
            'status' => 'approved', // temp value
        ]);

        $totalWeightedScore = 0;
        $totalWeight = 0;

        // Save KPI reviews with weighted score calculation
        if (!empty($validated['kpis'])) {
            foreach ($validated['kpis'] as $kpi) {
                $kpiModel = PositionKPI::find($kpi['position_kpi_id']);
                $weight = $kpiModel->weight ?? 0;

                TaskKpiReview::create([
                    'task_id' => $task->id,
                    'position_kpi_id' => $kpi['position_kpi_id'],
                    'score' => $kpi['score'],
                ]);

                $totalWeightedScore += $kpi['score'] * $weight;
                $totalWeight += $weight;
            }
        }

        if ($totalWeight > 0) {
            $task->average_score = round($totalWeightedScore / $totalWeight, 2); // weighted average
            $task->save();
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully with KPI reviews.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $sprints = Sprint::all();
        $users = User::with('position.kpis')->get();

        // Load existing KPI reviews
        $kpiScores = $task->kpi_scores ?? [];

        return view('admin.tasks.edit', compact('task', 'sprints', 'users', 'kpiScores'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function show(Task $task)
    {
        $sprints = Sprint::all();
        $users = User::with('position.kpis')->get();

        // Load existing KPI reviews
        $kpiScores = $task->kpi_scores ?? [];

        return view('admin.tasks.show', compact('task', 'sprints', 'users', 'kpiScores'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'sprint_id' => 'required|exists:sprints,id',
            'task_id' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'task_date' => 'nullable|date',
            'kpis' => 'nullable|array',
            'kpis.*.position_kpi_id' => 'required|exists:position_kpis,id',
            'kpis.*.score' => 'required|numeric|min:1|max:10',
        ]);

        $task->update([
            'sprint_id' => $validated['sprint_id'],
            'user_id' => $validated['user_id'],
            'task_id' => $validated['task_id'],
            'task_date' => $validated['task_date'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'approved', // temp value
        ]);

        $totalWeightedScore = 0;
        $totalWeight = 0;

        // Sync KPI reviews
        if (!empty($validated['kpis'])) {
            foreach ($validated['kpis'] as $kpi) {
                $kpiModel = PositionKPI::find($kpi['position_kpi_id']);
                $weight = $kpiModel->weight ?? 0;

                $review = TaskKpiReview::updateOrCreate(
                    ['task_id' => $task->id, 'position_kpi_id' => $kpi['position_kpi_id']],
                    ['score' => $kpi['score']]
                );

                $totalWeightedScore += $kpi['score'] * $weight;
                $totalWeight += $weight;
            }
        }

        if ($totalWeight > 0) {
            $task->average_score = round($totalWeightedScore / $totalWeight, 2);
            $task->save();
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }


    protected function calculateWeightedAverage($kpis)
    {
        $total = 0;
        $weightSum = 0;

        foreach ($kpis as $kpi) {
            $weight = \App\Models\PositionKPI::find($kpi['id'])->weight;
            $score = $kpi['score'];

            $total += $score * $weight;
            $weightSum += $weight;
        }

        return $weightSum > 0 ? round($total / $weightSum, 2) : null;
    }
}
