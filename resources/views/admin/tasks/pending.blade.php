@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">⏳ Tasks</h3>
        </div>

        @if ($tasks->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle shadow-sm">
                    <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Task ID</th>
                        <th>User</th>
                        <th>Sprint</th>
                        <th>Date</th>
                        <th>Avg Score</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td class="fw-semibold">{{ $task->task_id }}</td>
                            <td>{{ $task->user->name ?? '—' }}</td>
                            <td>{{ $task->sprint->title ?? '—' }}</td>
                            <td>{{ $task->task_date ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $task->average_score ?? '0.00' }}
                                </span>
                            </td>
                            <td>{{ $task->status}}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-sm btn-info px-3">
                                        👁️ Show
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No pending tasks are waiting for approve.
            </div>
        @endif
    </div>
@endsection
