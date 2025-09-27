<x-layout>
    <h1 class="mt-8 mb-8 text-center text-3xl font-medium text-slate-600">
        Forgot Password?
    </h1>
    <x-card class="py-8 px-16">
        <div class="mb-4 text-base">Enter the email address associated with your account and we will send you a link to reset your password.</div>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label for="email" :required="true">Email</x-label>
                <x-text-input name="email" :value="old('email')" />
            </div>
            <x-button class="w-full bg-green-300 hover:bg-green-500">Request Password Reset</x-button>
        </form>
    </x-card>
</x-layout>
