<h1>Edit Role</h1>

<form action="{{ route('roles.update', $role) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $role->name) }}"
        >
    </div>

    <h3>Abilities</h3>

    @foreach($abilities as $ability)

        <label>

            <input
                type="checkbox"
                name="abilities[]"
                value="{{ $ability }}"
                @checked(in_array($ability, $role->abilities))
            >

            {{ $ability }}

        </label>

        <br>

    @endforeach

    <button type="submit">
        Update
    </button>
</form>