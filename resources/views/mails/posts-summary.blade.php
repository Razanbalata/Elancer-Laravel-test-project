<x-mail::message>
<div>
    @foreach ($posts as $post)
        <article>
            <h3>{{$post->title}}</h3>
            <p>{{$post->content}}</p>
        </article>
    @endforeach
</div>
</x-mail::message>
