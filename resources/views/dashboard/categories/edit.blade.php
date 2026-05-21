@include('dashboard.categories.create', [
    'category' => $category,
    'action' => route('dashboard.categories.update', $category->id),
    ($method = 'PUT'),
])
