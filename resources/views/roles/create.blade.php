<h1>Create Role</h1>

<form action="{{ route('roles.store') }}" method="POST">
    @csrf

    <div>
        <label>Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
        >

        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <hr>

    <h3>Abilities</h3>

    @foreach($abilities as $ability)
        <div>
            <label>
                <input
                    type="checkbox"
                    name="abilities[]"
                    value="{{ $ability }}"
                >

                {{ $ability }}
            </label>
        </div>
    @endforeach

    @error('abilities')
        <p>{{ $message }}</p>
    @enderror

    <button type="submit">
        Save
    </button>
</form>