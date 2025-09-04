<x-layout>
    <h1 class="mt-8 mb-8 text-center text-3xl font-medium text-slate-600">
        Verify your email address
    </h1>
    <x-card class="py-8 px-16">
        <p class="mb-4 text-sm text-slate-500">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>

        @if(session('status') == 'verification-link-sent')
            <p class="mb-4 text-base text-green-700">Verification link sent!</p>
        @endif

        <div class="w-full flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-button class="w-1/3 bg-green-300 hover:bg-green-500">
                    Resend Verification Email
                </x-button>
            </form>

            <form method="POST" action="{{ route('auth.destroy') }}">
                @csrf
                @method('DELETE')
                <x-button class="w-1/3 bg-green-300 hover:bg-green-500">
                    Logout
                </x-button>
            </form>
        </div>
    </x-card>
</x-layout>

