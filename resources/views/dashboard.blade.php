@extends('layouts.user')

@section('content')
    <div class="col-md-12 p-4" style="background: #f4f5f7">

        <h4 class="mb-4">📊 User Tasks Dashboard</h4>

        <div class="row mb-4">
            <!-- User Info -->
            <div class="col-md-4">
                <div class="card shadow-sm rounded p-3 bg-white" style="height: 140px;">
                    <h6>👤 User Info</h6>
                    <p class="mb-1"><strong>Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Position:</strong> {{ auth()->user()->position->title ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Average Score -->
            <div class="col-md-4">
                <div class="card shadow-sm rounded p-3 bg-white">
                    <h6>✅ Average Score</h6>
                    <p><strong>Score:</strong> {{ $score !== null ? number_format($score, 1) : 'N/A' }}</p>
                    <p>Total Tasks: <strong>{{ $taskCount }}</strong></p>
                </div>
            </div>

            <!-- Create Task -->
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card shadow-sm rounded p-3 bg-white w-100">
                    <h6>➕ Create New Task</h6>
                    <a href="{{route('user.tasks.create')}}" class="btn btn-primary w-100 mt-2">
                        <i class="bi bi-plus-circle me-1"></i> New Task
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" class="row mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Sprint</label>
                <select name="sprint_id" class="form-select">
                    @foreach($sprints as $sprint)
                        <option value="{{ $sprint->id }}" {{ request('sprint_id', $sprintId) == $sprint->id ? 'selected' : '' }}>
                            {{ $sprint->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-success w-100">🔍 Filter</button>
            </div>
        </form>

        <!-- Task Stats -->
        <div class="card shadow-sm rounded p-3 bg-white">
            <h6>📈 Sprint Tasks</h6>
            @if($tasks->count())
                <table class="table table-bordered mt-3 text-left">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task ID</th>
                            <th>Title</th>
                            <th>Score</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->task_id }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->average_score }}</td>
                                <td>{{ $task->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
@endsection
