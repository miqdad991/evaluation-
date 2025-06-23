@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">📄 View Task & Evaluation</h4>
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-sm btn-outline-secondary">← Back to List</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Sprint</label>
                        <input type="text" class="form-control" value="{{ $task->sprint->title ?? 'N/A' }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">User</label>
                        <input type="text" class="form-control" value="{{ $task->user->name }} ({{ $task->user->position->title ?? 'No Position' }})" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Task ID</label>
                        <input type="text" class="form-control" value="{{ $task->task_id }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Task Title</label>
                        <input type="text" class="form-control" value="{{ $task->title }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Task Description</label>
                        <textarea class="form-control" rows="3" disabled>{{ $task->description }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Task Date</label>
                        <input type="date" class="form-control" value="{{ $task->task_date }}" disabled>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="mb-3">📊 KPI Evaluation</h5>
                    @forelse($task->user->position->kpis ?? [] as $index => $kpi)
                        @php
                            $review = $task->kpiReviews->where('position_kpi_id', $kpi->id)->first();
                            $score = $review->score ?? 0;
                        @endphp
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <strong>{{ $kpi->name }}</strong>
                                <small class="text-muted">(Weight: {{ $kpi->weight }}%)</small>
                                <p class="text-muted small">{{ $kpi->how_to_measure }}</p>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="star-rating-static ms-2">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <i class="bi bi-star-fill star {{ $i <= $score ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                </div>
                                <span class="score-percentage ms-2 text-muted">{{ $score * 10 }}%</span>
                            </div>
                        </div>
                    @empty
                        <p>No KPIs available for this user.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
