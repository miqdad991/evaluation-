<x-guest-layout>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input name="email" type="email" required />
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password" required />
        </div>
        <button type="submit">Login as Admin</button>
    </form>
</x-guest-layout>
