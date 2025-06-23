@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">➕ Add Position</h4>
                <a href="{{ route('admin.positions.index') }}" class="btn btn-sm btn-outline-secondary">
                    ← Back to List
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.positions.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Position Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter position title..."
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        💾 Save Position
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
