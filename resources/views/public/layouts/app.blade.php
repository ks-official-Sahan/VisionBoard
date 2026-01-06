<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'VisionBoard')</title>

    @include('public.libraries.tailwindcss')
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased flex flex-col">
    <a href="#main"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-slate-900 focus:text-white focus:rounded-md">
        Skip to main content
    </a>

    @include('public.components.header')

    <main id="main" class="flex-1 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-8 w-full">
        @if (session('status') || session('error'))
            <div class="mb-4" role="status">
                @if (session('status'))
                    <p class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm text-emerald-900">
                        {{ session('status') }}
                    </p>
                @endif
                @if (session('error'))
                    <p class="rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-900 mt-2">
                        {{ session('error') }}
                    </p>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    @include('public.components.footer')
</body>

</html>
