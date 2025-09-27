<script>
    function fetchCaptcha(e) {
        e.preventDefault();

        fetch('/fetch-captcha', {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        })
        .then((response) => response.json())
        .then((data) => {
            document.getElementById('captcha-img').innerHTML = data.captcha;
        })
    }
</script>
<x-layout>
    <h1 class="mt-8 mb-8 text-center text-3xl font-medium text-slate-600">
        Register an account
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name" :value="old('name')"/>
            </div>
            <div class="mb-4">
                <x-label for="email" :required="true">Email</x-label>
                <x-text-input name="email" :value="old('email')"/>
            </div>
            <div class="mb-4">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password" />
            </div>
            <div class="mb-4">
                <x-label for="password_confirmation" :required="true">Retype Password</x-label>
                <x-text-input name="password_confirmation" type="password" />
            </div>
            <div class="mb-4">
                <div class="flex items-start gap-2">
                    <div id="captcha-img" class="mb-2">{!! captcha_img() !!}</div>
                    <div class="relative">
                        <button class="round-md border border-green-500 shadow-sm w-8 h-8 px-2.5 py-2.5 bg-green-500 hover:bg-green-600" onclick="fetchCaptcha(event);" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="absolute size-4 top-2 right-2">
    <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd" />
    </svg>
                    </div>
                </div>
                <x-text-input name="captcha" placeHolder="Please enter Captcha" />
            </div>
            <x-button class="w-full bg-green-300 hover:bg-green-500">Register</x-button>
        </form> 
    </x-card>
</x-layout>