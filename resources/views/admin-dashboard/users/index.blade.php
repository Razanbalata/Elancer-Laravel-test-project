<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Users</h1>

        <a href="{{ route('admin-dashboard.users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Create User
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="p-3">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>

                        <td>
                            @foreach($user->roles as $role)
                                <span class="bg-gray-200 px-2 py-1 rounded text-sm">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>

                        <td class="flex gap-2 p-2">
                            <a href="{{ route('admin-dashboard.users.edit', $user) }}"
                               class="text-blue-600">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin-dashboard.users.destroy', $user) }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600"
                                        onclick="return confirm('Delete user?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>