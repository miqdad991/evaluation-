<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;

class SprintController extends Controller
{
    public function index()
    {
        $sprints = Sprint::latest()->paginate(10);
        return view('admin.sprints.index', compact('sprints'));
    }

    public function create()
    {
        return view('admin.sprints.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Sprint::create($request->only('title'));
        return redirect()->route('admin.sprints.index')->with('success', 'Sprint added successfully.');
    }

    public function edit(Sprint $sprint)
    {
        return view('admin.sprints.edit', compact('sprint'));
    }

    public function update(Request $request, Sprint $sprint)
    {
        $request->validate(['title' => 'required']);
        $sprint->update($request->only('title'));
        return redirect()->route('admin.sprints.index')->with('success', 'Sprint updated successfully.');
    }

    public function destroy(Sprint $sprint)
    {
        $sprint->delete();
        return redirect()->route('admin.sprints.index')->with('success', 'Sprint deleted successfully.');
    }
}
