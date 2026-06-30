<div class="bg-white border border-outline-variant rounded-xl p-6 space-y-6">
    <h3 class="font-headline-md text-[20px] text-on-surface">Trending on Ink</h3>
    <div class="space-y-6">
        @foreach ($trendingPosts as $post)
            <div class="flex gap-4">
                <span class="font-display-lg text-secondary opacity-30 leading-none">{{ sprintf('%02d', $loop->iteration) }}</span>
                <div class="space-y-1">
                    <a href="{{ route('posts.show', $post->slug) }}"
                        class="block font-ui-label text-ui-label font-bold text-on-surface leading-tight hover:text-primary cursor-pointer">
                        {{ $post->title }}
                    </a>
                    <p class="font-metadata text-metadata text-secondary">{{ $post->category->name }} • {{ $post->read_time }} min read</p>
                </div>
            </div>
        @endforeach
    </div>
</div>