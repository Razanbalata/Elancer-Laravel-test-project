<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form method="POST" action="{{ route('admin-dashboard.users.update', $user) }}" class="space-y-3">

        @csrf
        @method('PUT')

        <input class="border p-2 w-full" name="name" value="{{ $user->name }}">

        <input class="border p-2 w-full" name="username" value="{{ $user->username }}">

        <input class="border p-2 w-full" name="email" value="{{ $user->email }}">

        <input class="border p-2 w-full" type="password" name="password" placeholder="Leave empty if no change">

        <div>
            <h3 class="font-bold mb-2">Roles</h3>

            @foreach ($roles as $role)
                <label class="block">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" @checked($user->roles->contains($role->id))>
                    {{ $role->name }}
                </label>
            @endforeach
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>
