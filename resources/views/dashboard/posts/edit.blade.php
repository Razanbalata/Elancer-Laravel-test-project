@include('dashboard.posts.create',[
    'post' => $post,
    $action = route('dashboard.posts.update', $post->id),
    $method = 'PUT',
]);