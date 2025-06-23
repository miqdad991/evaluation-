@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>🧑 Tasks for {{ $user->name }}</h4>
            <a href="{{ route('admin.tasks.create', ['user_id' => $user->id]) }}" class="btn btn-success">
                ➕ Add New Task
            </a>
        </div>
        <p><strong>Date Range:</strong> {{ $dateFrom }} → {{ $dateTo }}</p>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Date</th>
                <th>Task ID</th>
                <th>Title</th>
                <th>Score</th>
                <th>Sprint</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->task_date }}</td>
                    <td>{{ $task->task_id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ number_format($task->average_score, 1) }}</td>
                    <td>{{ $task->sprint->title ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.tasks.show', $task) }}" class="btn btn-sm btn-info px-3">
                            👁️ Show
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No tasks found in selected period.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
