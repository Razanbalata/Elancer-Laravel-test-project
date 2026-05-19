@props([
    'title'=>"The Sunday Sdddd",
])

<div class="p-6 bg-primary-container rounded-xl text-on-primary space-y-4">
    <h3 class="font-headline-md text-[20px]">{{ $title ?? "New News" }}</h3>
    <p class="font-metadata text-metadata text-on-primary-container">Join 40,000+ creators receiving our
        weekly
        digest on design, code, and intentional living.</p>
    <div class="space-y-2">
        {{ $slot }} {{ $helper ?? '' }}
        <input
            class="w-full px-4 py-2 rounded bg-white/10 border border-white/20 text-white placeholder:text-white/60 focus:ring-1 focus:ring-white focus:outline-none"
            placeholder="email@example.com" type="email" />
        
    </div>
</div>
