<x-layout title="Notifications" mainClass="py-10">

    {{-- <main class="max-w-article-max mx-auto px-margin-mobile md:px-0 mt-12 mb-section-gap">
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
            <!-- Today -->
            <section>
                <h2 class="font-ui-label text-ui-label text-secondary uppercase tracking-widest mb-6">Today</h2>
                <div class="space-y-0.5">
                    <!-- Notification Item 1 (Unread) -->
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        <div class="relative">
                            <img alt="User avatar" class="w-10 h-10 rounded-full object-cover"
                                data-alt="A sharp, detailed portrait of a female content creator with an expressive and friendly gaze. She is in a bright, airy office space with soft daylight illuminating her face. The style is modern, editorial, and sophisticated, using a clean color palette of whites and soft grays to match a minimalist UI."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGGrOTRZ4oOZEwmPOZf1jajXk3ACI-FgU9Wxjw9g32MU9hVmmqfAQSuc83lqN2QZuYiciON55u-8q1fSp4stgQNxZ5wNjTymst0-yNpu0p4bygHN1PhVJ66z34ozhDCgbtn51dQNaCU2JtfJwXOMYZycr-6wf6LpAfiA1FgHeVxMG0l55x2nIqvxuQ87_cjIVhxnszQPe7Whz_OaGiV73Ol73grvJbZZ5umXhSke9Mb20D0oXzz3nfWt18XwpBsn31yLxlxxz-sg5S" />
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-[14px] text-primary" data-icon="favorite"
                                    style="font-variation-settings: 'FILL' 1;">favorite</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-on-surface leading-tight">
                                <span class="font-bold">Sarah Chen</span> liked your article <span
                                    class="italic text-primary">"The Future of Minimalist UI"</span>
                            </p>
                            <span class="font-metadata text-metadata text-secondary mt-1 block">2 hours ago</span>
                        </div>
                        <div class="pt-2">
                            <div class="active-dot"></div>
                        </div>
                    </div>
                    <!-- Notification Item 2 (Read) -->
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        <div class="relative">
                            <img alt="User avatar" class="w-10 h-10 rounded-full object-cover"
                                data-alt="A professional portrait of a male designer with a thoughtful expression, set in a high-key studio environment. The background is a seamless light gray, creating a very clean and intentional aesthetic. The lighting is sharp, emphasizing texture and clarity in a way that feels premium and focused."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2iTGRsqZWx5fp2W37OEPtHMyDSE_dJqriiR0OXK-c5rmgi48DO3V_i8WZ3z0jgTDIdUMvmeMpgD_HEYA62uIHZNAnyJ99YSd1D9PoT2io9z63pRLE7Mp_OPAxG0MUx4GkvE6HjieqyoQrEYKc6v3yOUilIiD0oSkdMhoCE9f-3lhdEW2GnoV2jH74T_983on2QNNNS9CUhAvwc7tXKjD4bg6vsk8kIPHXEAT2-D7ORz2Dmi_V5izmo6TseS1x_ds4ywxlO2iZbNaJ" />
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-[14px] text-primary"
                                    data-icon="comment">comment</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-on-surface leading-tight">
                                <span class="font-bold">Marcus Thorne</span> replied to your comment on <span
                                    class="italic">"Typefaces of 2024"</span>
                            </p>
                            <p
                                class="font-metadata text-metadata text-secondary mt-1 bg-surface-container-low p-2 rounded-lg italic">
                                "I completely agree with the point about variable fonts becoming the standard..."
                            </p>
                            <span class="font-metadata text-metadata text-secondary mt-2 block">5 hours ago</span>
                        </div>
                    </div>
                    <!-- Notification Item 3 (Stats) -->
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary"
                                    data-icon="trending_up">trending_up</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-on-surface leading-tight">
                                Your article <span class="font-bold text-on-surface">"Sustainable Design Systems"</span>
                                reached <span class="font-bold">5,000 views</span> this week.
                            </p>
                            <span class="font-metadata text-metadata text-secondary mt-1 block">8 hours ago</span>
                        </div>
                        <div class="pt-2">
                            <div class="active-dot"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Yesterday -->
            <section>
                <h2 class="font-ui-label text-ui-label text-secondary uppercase tracking-widest mb-6">Yesterday</h2>
                <div class="space-y-0.5">
                    <!-- Notification Item 4 -->
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        <div class="relative">
                            <img alt="User avatar" class="w-10 h-10 rounded-full object-cover"
                                data-alt="A portrait of a senior software engineer looking directly at the camera with a confident, welcoming smile. The setting is a modern open-plan office with soft-focus architectural elements in the background. High-contrast monochromatic foundations with sharp clarity define the image style."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkYicyp6XkbvLmy4FqgHdI-3KZ8onO6GLqz5MhtlByYNz_7vq9vMgKj7lH7yOKpyTcW0N9I_Tqi9ftccceVEsbJz4Ot7F1GwKNsaBWWxsMvPkL9qj1umMj1CGm9tRrB7UHD-l33ZsEUdtGmtqil2XL60SQKIX7Yu04-_z99knQmddAl0ue9OJFAZ39QasfXwB4-rgwvEuqCTlPXsclrN0G2svB6qq9htWTRkZNocgEbzs38oqFZLijzP3i67pcS05CDgeWN6wnAf6d" />
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-[14px] text-primary"
                                    data-icon="person_add">person_add</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-on-surface leading-tight">
                                <span class="font-bold">Elena Rodriguez</span> started following you.
                            </p>
                            <span class="font-metadata text-metadata text-secondary mt-1 block">Yesterday, 10:42
                                AM</span>
                        </div>
                    </div>
                    <!-- Notification Item 5 -->
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        <div class="relative">
                            <img alt="User avatar" class="w-10 h-10 rounded-full object-cover"
                                data-alt="A high-quality, professional headshot of a male editor in a minimal studio setting. The lighting is directional and dramatic yet clean, casting soft shadows that highlight features without losing clarity. The aesthetic is professional, sophisticated, and perfectly suited for a premium reading platform."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDuPcJJ0QeKtG-LOhZiO-7Vs-B8OsRsJoaWOyHDZULkQCN_DixrNpzsV-eREUT2Lh8FWrzyZjKmtODtlE9UUah77Ts2qxFtkqKuSKbb7oQdaj3_l3JHd7cvW_1kd_5q4aG5262d-ellWYyQnJzYlj8DTAoYF_CIF1kgnHc4XBlVdsJnEYR_k3Ypacobk-Vr7ZwvHwV-Ro3GP-ks_WtZy6tHbqu0j5ndQSq68-rNQpRW2zO-8CbrqGVFxA65FILzOvillFWv5UeDaPFk" />
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-[14px] text-primary"
                                    data-icon="alternate_email">alternate_email</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-on-surface leading-tight">
                                <span class="font-bold">David Kim</span> mentioned you in <span class="italic">"The
                                    Evolution of Digital Ink"</span>
                            </p>
                            <span class="font-metadata text-metadata text-secondary mt-1 block">Yesterday, 4:15
                                PM</span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- This Week -->
            <section>
                <h2 class="font-ui-label text-ui-label text-secondary uppercase tracking-widest mb-6">Earlier this week
                </h2>
                <div class="space-y-0.5">
                    <div
                        class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center">
                                <span class="material-symbols-outlined text-on-surface"
                                    data-icon="auto_awesome">auto_awesome</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-on-surface leading-tight">
                                Your collection <span class="font-bold">"Typography Explorations"</span> was curated for
                                the <span class="text-primary font-bold">Ink &amp; Paper Monthly Digest</span>.
                            </p>
                            <span class="font-metadata text-metadata text-secondary mt-1 block">Monday, 9:00 AM</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Loading Indicator / End of feed -->
        <div
            class="mt-16 flex flex-col items-center justify-center py-8 border-t border-outline-variant border-dashed">
            <span class="material-symbols-outlined text-secondary mb-2" data-icon="history_edu">history_edu</span>
            <p class="font-metadata text-metadata text-secondary">You're all caught up for the week.</p>
        </div>
    </main> --}}
    <main class="flex-grow w-full max-w-container-max mx-auto px-gutter py-12">

        @foreach ($notifications as $notification)
            <div class='p-3 bg-white rounded shadow:sm'>
                <h3>{{ $notification->data['title'] }}</h3>
                <p>{{ $notification->data['body'] }}</p>
                <div>{{ $notification->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </main>
</x-layout>
