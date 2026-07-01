<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class PostBookmark extends Component
{
    public bool $isBookmarked;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public Post $post,
        public string $class = '',
    ) {
        $this->isBookmarked = $this->resolveBookmarkStatus();
    }

    protected function resolveBookmarkStatus(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        if (isset($this->post->bookmarked_by_exists)) {
            return (bool) $this->post->bookmarked_by_exists;
        }

        return Auth::user()
            ->bookmarkedPosts()
            ->where('posts.id', $this->post->id)
            ->exists();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-bookmark');
    }
}
