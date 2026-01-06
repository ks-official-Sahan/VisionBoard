<header class="border-b border-slate-200 bg-white/80 backdrop-blur">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16" role="navigation"
        aria-label="Primary">
        <div class="flex items-center gap-2">
            <span
                class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-slate-900 text-white text-sm font-semibold"
                aria-hidden="true">VB</span>
            <span class="text-lg font-semibold tracking-tight">VisionBoard</span>
        </div>

        <nav class="flex items-center gap-4 text-sm font-medium">
            <a href="{{ route('home') }}"
                class="text-slate-700 hover:text-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Home</a>

            @auth
                @php($headerUser = auth()->user())
                @php($headerProfileImage = $headerUser->profile_image_path ? asset('storage/' . $headerUser->profile_image_path) : null)

                <div class="hidden sm:flex items-center gap-3 text-xs text-slate-700" aria-label="Current user">
                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-slate-200 text-[11px] font-semibold text-slate-900 overflow-hidden">
                        @if ($headerProfileImage)
                            <img src="{{ $headerProfileImage }}" alt="{{ $headerUser->name }}'s profile image"
                                class="h-full w-full object-cover">
                        @else
                            {{ strtoupper(mb_substr($headerUser->name, 0, 2)) }}
                        @endif
                    </span>
                    <span class="max-w-[10rem] truncate">{{ $headerUser->name }}</span>
                </div>

                <a href="{{ route('profile') }}"
                    class="text-slate-700 hover:text-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Profile</a>

                <form method="post" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-slate-700 hover:text-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="text-slate-700 hover:text-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Login</a>
                <a href="{{ route('signup') }}"
                    class="inline-flex items-center rounded-md bg-slate-900 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Sign
                    up</a>
            @endguest
        </nav>
    </div>
</header>
