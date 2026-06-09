@props(['post'])

<article
    class="group border border-outline-variant rounded-xl overflow-hidden bg-white hover:border-primary transition-colors duration-300">

    <div class="aspect-[16/9] overflow-hidden">
        <img src="{{ $post->thumbnail_url }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
    </div>

    <div class="p-8 space-y-4">

        <div class="flex items-center gap-3 font-metadata text-metadata text-secondary">
            <span class="bg-primary-container text-on-primary px-2 py-0.5 rounded font-bold uppercase tracking-wider">
                Featured
            </span>

            <span>•</span>

            <span>{{ $post->publish_time->format('M d, Y') }}</span>
        </div>

        <h2
            class="font-headline-md text-headline-md text-on-surface leading-tight group-hover:text-primary transition-colors">
            {{ $post->title }}
        </h2>

        <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">
            {{ $post->content }}
        </p>

        <div class="flex items-center justify-between pt-4 border-t border-outline-variant">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-surface-container border overflow-hidden"></div>

                <div>
                    <p class="font-ui-label text-ui-label font-bold text-on-surface">
                        {{ $post->user->name }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</article>
