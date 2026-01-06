@extends('public.layouts.app')

@section('title', 'VisionBoard · Profile')

@section('content')
<section aria-labelledby="profile-heading" class="max-w-2xl mx-auto space-y-8">
    <header class="space-y-2">
        <h1 id="profile-heading" class="text-2xl font-semibold tracking-tight text-slate-900">Your public profile</h1>
        <p class="text-sm text-slate-600">Update your name, mobile number, password, and public profile image.</p>
    </header>

    @if ($errors->any())
    <div class="rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-900">
        <p>Please review the highlighted fields below.</p>
    </div>
    @endif

    <section aria-label="Profile image"
        class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm flex items-center gap-4">
        <div class="flex-shrink-0">
            @php($profileUser = auth()->user())
            @php($profileImage = $profileUser?->profile_image_path ? asset('storage/' .
            $profileUser->profile_image_path) : null)

            <div
                class="h-16 w-16 rounded-full bg-slate-200 overflow-hidden flex items-center justify-center text-sm font-semibold text-slate-700">
                @if ($profileImage)
                <img src="{{ $profileImage }}" alt="{{ $profileUser->name }}'s profile image"
                    class="h-full w-full object-cover">
                @else
                <span aria-hidden="true">{{ strtoupper(mb_substr(optional($profileUser)->name ?? 'VB', 0, 2)) }}</span>
                @endif
            </div>
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium text-slate-900">Public profile image</p>
            <p class="text-xs text-slate-600">This image is visible to anyone who can see your posts.</p>

            <form method="post" action="{{ route('profile.image') }}" enctype="multipart/form-data"
                class="mt-3 space-y-2">
                @csrf
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <input id="profile_image" name="profile_image" type="file" accept="image/*"
                        class="block w-full text-xs text-slate-700 file:mr-4 file:rounded-md file:border-0 file:bg-slate-900 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white hover:file:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                    <button type="submit"
                        class="inline-flex items-center rounded-md bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                        Upload
                    </button>
                </div>
                <p class="text-[11px] text-slate-500">JPEG or PNG up to 2MB.</p>
            </form>
        </div>
    </section>

    <form method="post" action="{{ route('profile.update') }}"
        class="space-y-5 rounded-lg border border-slate-200 bg-white p-5 shadow-sm" novalidate>
        @csrf
        @method('PUT')

        <fieldset class="space-y-4">
            <legend class="text-sm font-semibold text-slate-900">Profile details</legend>

            <div class="space-y-1">
                <label for="name" class="block text-sm font-medium text-slate-800">Full name</label>
                <input id="name" name="name" type="text" autocomplete="name" required
                    value="{{ old('name', optional(auth()->user())->name) }}"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('name')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="mobile_number" class="block text-sm font-medium text-slate-800">Mobile number</label>
                <input id="mobile_number" name="mobile_number" type="tel" autocomplete="tel" required
                    value="{{ old('mobile_number', optional(auth()->user())->mobile_number) }}"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('mobile_number')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </fieldset>

        <fieldset class="space-y-4">
            <legend class="text-sm font-semibold text-slate-900">Change password</legend>

            <div class="space-y-1">
                <label for="current_password" class="block text-sm font-medium text-slate-800">Current password</label>
                <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('current_password')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-slate-800">New password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" minlength="8"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('password')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-800">Confirm new
                    password</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
            </div>
        </fieldset>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit"
                class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                Save changes
            </button>
        </div>
    </form>
</section>
@endsection