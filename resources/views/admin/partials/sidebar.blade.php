<div class="col-md-2 bg-light min-vh-100 p-3">
    <ul class="nav flex-column sidebar">
        <li class="nav-title">Main Menu</li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('admin.dashboard') }}">🏠 Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.sprints.index') }}">📅 Sprint</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.positions.index') }}">👔 Positions</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">👤 Users</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.tasks.index') }}">📋 Tasks</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.tasks.pending') }}">⏳ Pending Tasks</a></li>
        <li class="nav-item"><a class="nav-link" href="#">📈 Reports</a></li>
        <li class="nav-item"><a class="nav-link" href="#">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100 text-danger p-0">
                    🚪 Logout
                </button>
            </form>
            </a>
        </li>
    </ul>
</div>
