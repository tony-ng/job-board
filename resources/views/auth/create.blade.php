<x-layout>
    <h1 class="mt-8 mb-8 text-center text-3xl font-medium text-slate-600">
        Sign in to your account
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label for="email" :required="true">Email</x-label>
                <x-text-input name="email" class="mb-4" :value="old('email')" />
            </div>
            <div class="mb-4">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password" class="mb-4" />
            </div>
            <div class="mb-4 flex justify-between text-sm font-medium">
                <div class="flex gap-1 items-center">
                    <input type="checkbox" name="remember" id="remember" class="round-md border-1 border-slate-400" />
                    <label for="remember">Remember me</label>
                </div>
                {{-- <a href="{{ route('auth.store') }}" class="text-indigo-600 hover:underline">Forget Password?</a> --}}
            </div>
            <x-button class="w-full bg-green-300 hover:bg-green-500">Login</x-button>
        </form> 
    </x-card>
</x-layout>