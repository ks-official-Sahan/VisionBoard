@extends('public.layouts.app')

@section('title', 'VisionBoard · Sign up')

@section('content')
    <section aria-labelledby="signup-heading" class="max-w-md mx-auto space-y-6">
        <header class="space-y-2 text-center">
            <h1 id="signup-heading" class="text-2xl font-semibold tracking-tight text-slate-900">Create your VisionBoard
            </h1>
            <p class="text-sm text-slate-600">Sign up with your email, name, mobile number, and a strong password.</p>
        </header>

        <form method="post" action="{{ route('signup') }}"
            class="space-y-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm" novalidate>
            @csrf

            <div class="space-y-1">
                <label for="name" class="block text-sm font-medium text-slate-800">Full name</label>
                <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('name')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-slate-800">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="mobile_number" class="block text-sm font-medium text-slate-800">Mobile number</label>
                <input id="mobile_number" name="mobile_number" type="tel" autocomplete="tel" required value="{{ old('mobile_number') }}"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
                @error('mobile_number')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-slate-800">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required minlength="8"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50"
                    aria-describedby="password-help">
                <p id="password-help" class="text-xs text-slate-500">Use at least 8 characters, including a number or
                    symbol.</p>
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-800">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                    required
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50">
            </div>

            <button type="submit"
                class="mt-2 inline-flex w-full items-center justify-center rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                Create account
            </button>

            <p class="text-xs text-slate-600 text-center">
                Already have an account?
                <a href="{{ url('/login') }}" class="font-medium text-slate-900 underline-offset-2 hover:underline">
                    Log in
                </a>
            </p>
        </form>
    </section>
@endsection