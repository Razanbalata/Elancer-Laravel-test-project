   @auth
       <a href="{{ route('dashboard.posts.create') }}"
           class="ml-2 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all">
           Create Post
       </a>
       <div class="ml-2">
           <span class="material-symbols-outlined" data-icon="account_circle">account_circle</span>
           {{ $user?->name }}
           <a href='{{ route('logout') }}' onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="ml-2 text-sm text-gray-500 hover:text-gray-700">
               logout

           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
               @csrf
           </form>
       </div>
  @else
       <a href="{{ route('login') }}"
           class="ml-2 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all">
           Login
       </a>
       <a href="{{ route('register') }}"
           class="ml-2 bg-secondary-container text-on-secondary px-6 py-2 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all">
           Register
       </a>     
   @endauth
