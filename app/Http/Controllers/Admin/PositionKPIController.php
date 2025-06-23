<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionKPIController extends Controller
{
    public function index(Position $position)
    {
        $kpis = $position->kpis()->paginate(10);
        return view('admin.kpis.index', compact('position', 'kpis'));
    }

    public function create(Position $position)
    {
        return view('admin.kpis.create', compact('position'));
    }

    public function store(Request $request, Position $position)
    {
        $data = $request->validate([
            'kpis.*.name' => 'required|string|max:255',
            'kpis.*.how_to_measure' => 'required|string',
            'kpis.*.target' => 'required|string',
            'kpis.*.weight' => 'required|numeric|min:0|max:100',
        ]);

        $totalWeight = collect($data['kpis'])->sum('weight');

        if ($totalWeight != 100) {
            return back()->withInput()->withErrors(['total_weight' => 'The total weight of all KPIs must be 100.']);
        }

        foreach ($data['kpis'] as $kpi) {
            $position->kpis()->create($kpi);
        }

        return redirect()->route('admin.positions.kpis.index', $position)->with('success', 'KPIs created successfully.');
    }

    public function edit(Position $position)
    {
        $kpis = $position->kpis; // Assuming one-to-many relationship: Position hasMany KPIs
        return view('admin.kpis.edit', compact('position', 'kpis'));
    }
    public function update(Request $request, Position $position)
    {
        $data = $request->validate([
            'kpis.*.id' => 'nullable|exists:position_kpis,id', // ✅ Fixed table name
            'kpis.*.name' => 'required|string|max:255',
            'kpis.*.how_to_measure' => 'required|string',
            'kpis.*.target' => 'required|string',
            'kpis.*.weight' => 'required|numeric|min:0|max:100',
        ]);

        // Check total weight = 100
        $totalWeight = collect($data['kpis'])->sum('weight');

        if ($totalWeight != 100) {
            return back()->withInput()->withErrors(['total_weight' => 'The total weight of all KPIs must be 100.']);
        }

        $submittedIds = [];

        foreach ($data['kpis'] as $kpiData) {
            if (!empty($kpiData['id'])) {
                // Update existing KPI
                $kpi = $position->kpis()->where('id', $kpiData['id'])->first();
                if ($kpi) {
                    $kpi->update($kpiData);
                    $submittedIds[] = $kpi->id;
                }
            } else {
                // Create new KPI
                $newKpi = $position->kpis()->create($kpiData);
                $submittedIds[] = $newKpi->id;
            }
        }

        // Delete removed KPIs
        $position->kpis()->whereNotIn('id', $submittedIds)->delete();

        return redirect()->route('admin.positions.kpis.index', $position)->with('success', 'KPIs updated successfully.');
    }

}
