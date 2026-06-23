<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold mb-4">Create User</h1>
    <form method="POST" action="{{ route('admin-dashboard.users.store') }}" class="space-y-3">
        @csrf

        <input class="border p-2 w-full" name="name" placeholder="Name">
        @error('name')
            <p class="text-red-500">{{ $message }}</p>
        @enderror

        <input class="border p-2 w-full" name="username" placeholder="Username">
        @error('username')
            <p class="text-red-500">{{ $message }}</p>
        @enderror

        <input class="border p-2 w-full" name="email" placeholder="Email">
        @error('email')
            <p class="text-red-500">{{ $message }}</p>
        @enderror

        <input class="border p-2 w-full" type="password" name="password" placeholder="Password">
        @error('password')
            <p class="text-red-500">{{ $message }}</p>
        @enderror

        <div>
            <h3 class="font-bold mb-2">Roles</h3>

            @foreach ($roles as $role)
                <label class="block">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                    {{ $role->name }}
                </label>
            @endforeach
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>
