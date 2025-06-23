@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">👔 Positions</h3>
            <a href="{{ route('admin.positions.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Position
            </a>
        </div>

        @if ($positions->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle shadow-sm">
                    <thead class="table-primary">
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 40%">Title</th>
                        <th style="width: 10%">KPIs Count</th>
                        <th style="width: 40%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->id }}</td>
                            <td class="fw-semibold">{{ $position->title }}</td>
                            <td>{{ $position->kpis()->count() }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.positions.kpis.index', $position) }}" class="btn btn-sm btn-info px-3">
                                        📊 View KPIs
                                    </a>
                                    <a href="{{ route('admin.positions.edit', $position) }}" class="btn btn-sm btn-warning px-3">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.positions.destroy', $position) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $positions->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No positions found. Click <strong>Add Position</strong> to create one.
            </div>
        @endif
    </div>
@endsection
