@extends('public.layouts.app')

@section('title', 'VisionBoard · Login')

@section('content')
<section aria-labelledby="login-heading" class="max-w-md mx-auto space-y-6">
    <header class="space-y-2 text-center">
        <h1 id="login-heading" class="text-2xl font-semibold tracking-tight text-slate-900">Log in to VisionBoard</h1>
        <p class="text-sm text-slate-600">Welcome back. Enter your credentials to continue.</p>
    </header>

    <form method="post" action="{{ route('login') }}"
        class="space-y-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm" novalidate>
        @csrf

        <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-slate-800">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
            @error('email')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-slate-800">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
            @error('password')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="mt-2 inline-flex w-full items-center justify-center rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
            Log in
        </button>

        <p class="text-xs text-slate-600 text-center">
            Don't have an account?
            <a href="{{ url('/signup') }}" class="font-medium text-slate-900 underline-offset-2 hover:underline">
                Sign up
            </a>
        </p>
    </form>
</section>
@endsection