<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Job Board</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-r from-purple-100 via-blue-100 to-green-100 text-slate-700">
        <div class="mx-auto mt-2 max-w-2xl">
            <nav class="mt-4 mb-8 flex justify-between text-lg font-medium">
                <ul>
                    <li><a href="{{ route('jobs.index') }}">Home</a></li>
                </ul>
                <ul class="flex gap-2">
                    @auth
                        <li>
                            <a href="{{ route('my-job-applications.index') }}">{{ auth()->user()->name ?? 'Anonymous' }}: applications</a>
                        </li>
                        <li>
                            <a href="{{ route('my-jobs.index') }}">My Jobs</a>
                        <li>
                            <form action="{{ route('auth.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>logout</button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('auth.create') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </nav>
            @if (session()->has('success'))
                <div class="mt-4 mb-4 rounded-md border-l-4 border-green-500 text-green-700 bg-green-200 p-4 text-base font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="mt-4 mb-4 rounded-md border-l-4 border-red-500 text-red-700 bg-red-200 p-4 text-base font-medium">
                    {{ session('error') }}
                </div>
            @endif
            {{ $slot }}
        </div>
    </body>
</html>
