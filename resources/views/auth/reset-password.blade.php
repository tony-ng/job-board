<x-layout>
    <h1 class="mt-8 mb-8 text-center text-3xl font-medium text-slate-600">
        Reset Password
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label for="email" :required="true">Email</x-label>
                <x-text-input name="email" :value="old('email')" />
            </div>
            <div class="mb-4">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password" />
            </div>
            <div class="mb-4">
                <x-label for="password_confirmation" :required="true">Retype Password</x-label>
                <x-text-input name="password_confirmation" type="password" />
            </div>
            <x-text-input name="token" type="hidden" :value="$token" />
            <x-button class="w-full bg-green-300 hover:bg-green-500">Reset Password</x-button>
        </form>
    </x-card>
</x-layout>
