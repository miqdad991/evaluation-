<?php

namespace App\Http\Controllers\User;
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sprint;
use App\Models\Task;
use App\Models\PositionKpi;
use App\Models\TaskKpiReview;

class TaskController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $sprints = Sprint::latest()->get();
        $positionKPIs = $user->position?->kpis ?? [];

        return view('user.tasks.create', compact('user', 'sprints', 'positionKPIs'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'sprint_id' => 'required|exists:sprints,id',
            'task_id' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'task_date' => 'nullable|date',
            'kpis' => 'nullable|array',
            'kpis.*.position_kpi_id' => 'required|exists:position_kpis,id',
            'kpis.*.score' => 'required|numeric|min:1|max:10',
        ]);

        $task = Task::create([
            'sprint_id' => $validated['sprint_id'],
            'user_id' => $user->id,
            'task_id' => $validated['task_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'task_date' => $validated['task_date'],
            'average_score' => 0,
            'status' => 'pending', // default for user-created
        ]);

        $totalWeightedScore = 0;
        $totalWeight = 0;

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
            $task->average_score = round($totalWeightedScore / $totalWeight, 2);
            $task->save();
        }

        return redirect()->route('dashboard')->with('success', 'Task submitted successfully and is pending approval.');
    }
}
