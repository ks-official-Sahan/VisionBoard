@extends('public.layouts.app')

@section('title', 'VisionBoard · Home')

@section('content')
    <section aria-labelledby="home-heading" class="space-y-8">
        <header class="space-y-2">
            <h1 id="home-heading" class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900">
                See the latest from your VisionBoard community
            </h1>
            <p class="max-w-2xl text-sm text-slate-600">
                Share a thought, a goal, or a snapshot of your day. Posts are public by default and visible on the home
                feed.
            </p>
        </header>

        {{-- Post composer --}}
        <section aria-label="Create a new post" class="rounded-lg border border-slate-200 bg-white shadow-sm">
            @guest
                <div class="p-4 sm:p-5 flex items-center justify-between gap-3">
                    <p class="text-sm text-slate-700">Log in to share your own VisionBoard posts.</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}"
                            class="rounded-md border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-800 hover:bg-slate-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Login</a>
                        <a href="{{ route('signup') }}"
                            class="rounded-md bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Sign
                            up</a>
                    </div>
                </div>
            @endguest

            @auth
                <form class="p-4 sm:p-5 space-y-3" method="post" action="{{ route('posts.store') }}">
                    @csrf
                <label for="new-post" class="block text-sm font-medium text-slate-800">
                    What's on your mind?
                </label>
                <textarea id="new-post" name="content" rows="3" maxlength="500"
                    class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50"
                    aria-describedby="new-post-help"></textarea>
                <p id="new-post-help" class="text-xs text-slate-500">
                    Maximum 500 characters. Your post will be visible to everyone.
                </p>
                @error('content')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <div class="flex items-center justify-between pt-2">
                    <p class="text-xs text-slate-500">Posting as your public profile.</p>
                    <button type="submit"
                        class="inline-flex items-center rounded-md bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                        Share
                    </button>
                </div>
            </form>
            @endauth
        </section>

        {{-- Feed --}}
        <section aria-label="Public posts" class="space-y-4">
            <h2 class="text-sm font-semibold tracking-wide text-slate-700 uppercase">Latest public posts</h2>

            <div class="space-y-3">
                @forelse(($posts ?? []) as $post)
                    <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm @if(isset($highlightPostId) && $highlightPostId === $post->id) ring-2 ring-slate-900 @endif" aria-label="Public post">
                        <header class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    {{ $post->user->name ?? 'Unknown user' }}
                                </p>
                                @if (isset($highlightPostId) && $highlightPostId === $post->id)
                                    <p class="mt-1 inline-flex items-center rounded-full bg-slate-900 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-white">
                                        Your new post
                                    </p>
                                @endif
                                <p class="text-xs text-slate-500">
                                    {{ $post->created_at?->diffForHumans() ?? '' }}
                                </p>
                            </div>

                            @if (isset($currentUserId) && $post->user_id === $currentUserId)
                                <form method="post" action="{{ route('posts.destroy', $post) }}" aria-label="Delete this post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-xs font-medium text-red-600 hover:text-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </header>

                        <p class="mt-3 text-sm text-slate-800 leading-relaxed">
                            {{ $post->content ?? '' }}
                        </p>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">
                        No public posts yet. Be the first to share something.
                    </p>
                @endforelse
            </div>
        </section>
    </section>
@endsection
