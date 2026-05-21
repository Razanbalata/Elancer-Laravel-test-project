<x-layout title="Categories" mainClass="pb-section-gap px-gutter">
    <div class="pt-24 pb-32 flex flex-col max-w-container-max mx-auto px-gutter gap-8">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Categories</h1>

            <a href="{{ route('dashboard.categories.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                + Add Category
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-100">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Slug</th>
                        <th class="p-4">Description</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4">{{ $category->id }}</td>
                            <td class="p-4 font-medium text-gray-800">{{ $category->name }}</td>
                            <td class="p-4 text-gray-600">{{ $category->slug }}</td>
                            <td class="p-4 text-gray-600">
                                {{ $category->description }}
                            </td>

                            <td class="p-4 flex gap-3">
                                <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Are you sure?')"
                                        class="text-red-600 hover:underline">
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
</x-layout>
