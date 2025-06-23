@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">📅 Sprints</h3>
            <a href="{{ route('admin.sprints.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Sprint
            </a>
        </div>

        @if ($sprints->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle shadow-sm">
                    <thead class="table-primary">
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 60%">Title</th>
                        <th style="width: 30%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sprints as $sprint)
                        <tr>
                            <td>{{ $sprint->id }}</td>
                            <td class="fw-semibold">{{ $sprint->title }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.sprints.edit', $sprint) }}" class="btn btn-sm btn-warning px-3">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.sprints.destroy', $sprint) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                {{ $sprints->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No sprints found. Click <strong>Add Sprint</strong> to create one.
            </div>
        @endif
    </div>
@endsection
