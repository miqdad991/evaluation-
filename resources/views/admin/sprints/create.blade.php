@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">➕ Add Sprint</h4>
                <a href="{{ route('admin.sprints.index') }}" class="btn btn-sm btn-outline-secondary">
                    ← Back to List
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.sprints.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Sprint Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter sprint title..."
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        💾 Save Sprint
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
