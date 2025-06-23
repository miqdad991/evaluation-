@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">👤 Users</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add User
            </a>
        </div>

        @if ($users->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle shadow-sm">
                    <thead class="table-primary">
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th style="width: 25%">Name</th>
                        <th style="width: 25%">Email</th>
                        <th style="width: 20%">Position</th>
                        <th style="width: 25%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->position->title ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning px-3">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.tasks.create', ['user_id' => $user->id]) }}" class="btn btn-sm btn-success px-3">
                                        ➕ New Task
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No users found. Click <strong>Add User</strong> to create one.
            </div>
        @endif
    </div>
@endsection
