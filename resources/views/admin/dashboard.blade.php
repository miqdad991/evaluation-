@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <h4>📊 User Tasks Dashboard</h4>
        <div class="row mt-4">
            <form method="GET" class="row g-2 mb-4">
                <div class="col-md-3">
                    <select name="sprint_id" class="form-select">
                        <option value="">-- All Sprints --</option>
                        @foreach($sprints as $sprint)
                            <option value="{{ $sprint->id }}" {{ $sprintId == $sprint->id ? 'selected' : '' }}>
                                {{ $sprint->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
                </div>

                <div class="col-md-2">
                    <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">🔍 Filter</button>
                </div>
            </form>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Position</th>
                    <th>Tasks Done</th>
                    <th>Average Score</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    @php
                        $taskCount = $user->tasks->count();
                        $avgScore = $user->tasks->avg('average_score');
                    @endphp
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->position->title ?? '-' }}</td>
                        <td>{{ $taskCount }}</td>
                        <td>{{ number_format($avgScore, 1) }}</td>
                        <td>
                            <a href="{{ route('admin.dashboard.user_tasks', ['user_id' => $user->id, 'sprint_id' => request('sprint_id')]) }}" class="btn btn-sm btn-outline-info">
                                View Tasks
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No users found.</td></tr>
                @endforelse
                </tbody>
            </table>

            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endsection

