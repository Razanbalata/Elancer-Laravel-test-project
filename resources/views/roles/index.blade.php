<h1>Roles</h1>

<a href="{{ route('roles.create') }}">
    Create Role
</a>

<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Abilities</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>

                <td>
                    {{ implode(', ', $role->abilities) }}
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role) }}">
                        Edit
                    </a>

                    <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $roles->links() }}
