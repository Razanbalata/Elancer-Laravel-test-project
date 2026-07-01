@auth
    <form method="post"
        action="{{ route($isBookmarked ? 'posts.unbookmark' : 'posts.bookmark', $post->id) }}"
        class="inline-flex">
        @csrf
        @if ($isBookmarked)
            @method('delete')
        @endif
        <button type="submit" title="{{ $isBookmarked ? 'Remove bookmark' : 'Add bookmark' }}"
            class="material-symbols-outlined transition-colors {{ $isBookmarked ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }} {{ $class }}"
            @if ($isBookmarked) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>
            bookmark
        </button>
    </form>
@else
    @if (Route::has('login'))
        <a href="{{ route('login') }}" title="Sign in to bookmark"
            class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors {{ $class }}">
            bookmark
        </a>
    @else
        <span title="Sign in to bookmark"
            class="material-symbols-outlined text-on-surface-variant {{ $class }}">
            bookmark
        </span>
    @endif
@endauth
