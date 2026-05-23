<x-layout title="Create Category" mainClass="pt-24 pb-section-gap px-gutter">

    <div class="max-w-2xl mx-auto bg-white shadow border border-gray-100 rounded-xl p-8">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Create Category
        </h1>

        <form action="{{$action ?? route('dashboard.categories.store') }}" method="POST" class="space-y-5">
            @csrf
            @if (($method ?? 'POST') !== 'POST')
                @method($method)
            @endif
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Name
                </label>
                <input
                value="{{ $category->name ?? "" }}"
                type="text"
                       name="name"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Slug
                </label>
                <input
                value="{{ $category->slug ?? "" }}"
                type="text"
                       name="slug"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea 
                value="{{ $category->description ?? "" }}"
                name="description"
                          rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                Save Categphory
            </button>

        </form>

    </div>

</x-layout>