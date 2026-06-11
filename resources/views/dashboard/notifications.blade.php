<x-layout title="Notifications" mainClass="py-10">

    <main class="max-w-article-max mx-auto px-margin-mobile md:px-0 mt-12 mb-section-gap">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Notifications</h1>
                <p class="font-metadata text-metadata text-secondary">Stay updated with your latest interactions and
                    community activity.</p>
            </div>
            <button
                class="font-ui-label text-ui-label text-primary hover:underline underline-offset-4 flex items-center gap-2">
                Mark all as read
            </button>
        </div>
        <!-- Filter Tabs -->
        <div class="flex items-center gap-6 border-b border-outline-variant mb-10 overflow-x-auto no-scrollbar">
            <button
                class="font-ui-label text-ui-label pb-4 border-b-2 border-primary text-primary font-bold whitespace-nowrap">
                All
            </button>
            <button
                class="font-ui-label text-ui-label pb-4 text-secondary hover:text-on-surface transition-colors whitespace-nowrap">
                Responses
            </button>
            <button
                class="font-ui-label text-ui-label pb-4 text-secondary hover:text-on-surface transition-colors whitespace-nowrap">
                Mentions
            </button>
            <button
                class="font-ui-label text-ui-label pb-4 text-secondary hover:text-on-surface transition-colors whitespace-nowrap">
                Stats
            </button>
        </div>
        <!-- Notification Groups -->
        <div class="space-y-12">
            
            <section>
                <h2 class="font-ui-label text-ui-label text-secondary uppercase tracking-widest mb-6">Today</h2>
                <div class="space-y-0.5">
                    <!-- Notification Item 1 (Unread) -->
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        @foreach ($notifications as $notification)
            <div class='p-3 bg-white rounded shadow:sm'>
                <h3>{{ $notification->data['title'] }}</h3>
                <p>{{ $notification->data['body'] }}</p>
                <div>{{ $notification->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
                </div>
            </section>
            
        </div>
        
    </main>

</x-layout>
