@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">✏️ Edit Task</h4>
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-sm btn-outline-secondary">← Back to List</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $task->user_id }}" />

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sprint_id" class="form-label">Sprint</label>
                            <select name="sprint_id" id="sprint_id" class="form-select" required>
                                @foreach($sprints as $sprint)
                                    <option value="{{ $sprint->id }}" {{ $task->sprint_id == $sprint->id ? 'selected' : '' }}>
                                        {{ $sprint->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">User</label>
                            <input type="text" class="form-control" value="{{ $task->user->name }} ({{ $task->user->position->title ?? 'No Position' }})" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="task_id" class="form-label">Task ID</label>
                            <input type="text" name="task_id" id="task_id" class="form-control" value="{{ $task->task_id }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="title" class="form-label">Task Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="description" class="form-label">Task Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="task_date" class="form-label">Task Date</label>
                            <input type="date" name="task_date" id="task_date" class="form-control" value="{{ $task->task_date }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="mb-3">🎯 KPI Reviews</h5>
                        @forelse($task->user->position->kpis ?? [] as $index => $kpi)
                            @php
                                $review = $task->kpiReviews->where('position_kpi_id', $kpi->id)->first();
                                $score = $review->score ?? 3;
                            @endphp
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <strong>{{ $kpi->name }}</strong>
                                    <small class="text-muted">(Weight: {{ $kpi->weight }}%)</small>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="hidden" name="kpis[{{ $index }}][position_kpi_id]" value="{{ $kpi->id }}">
                                    <input type="hidden" name="kpis[{{ $index }}][score]" id="star-score-{{ $index }}" value="{{ $score }}">

                                    <div class="star-rating ms-2" data-input-id="star-score-{{ $index }}">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <i class="bi bi-star-fill star {{ $i <= $score ? 'active' : '' }}" data-value="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                    <span class="score-percentage ms-2 text-muted">{{ $score * 10 }}%</span>
                                </div>
                            </div>
                        @empty
                            <p>No KPIs available for this user.</p>
                        @endforelse
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary mt-3">💾 Update Task</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const starContainers = document.querySelectorAll('.star-rating');

            starContainers.forEach(container => {
                const inputId = container.getAttribute('data-input-id');
                const hiddenInput = document.getElementById(inputId);
                const stars = container.querySelectorAll('.star');
                const percentageDisplay = container.parentElement.querySelector('.score-percentage');

                function updateStars(score) {
                    stars.forEach((star, idx) => {
                        star.classList.toggle('active', idx < score);
                    });
                    hiddenInput.value = score;
                    if (percentageDisplay) {
                        percentageDisplay.textContent = (score * 10) + '%';
                    }
                }

                stars.forEach((star, index) => {
                    star.addEventListener('click', () => updateStars(index + 1));
                });

                updateStars(parseInt(hiddenInput.value || 3));
            });
        });
    </script>
@endpush
