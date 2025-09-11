<x-layout>
    <x-card class="py-8 px-16">
        <h2 class="mb-4 text-lg font-medium">
            Register as an employer
        </h2>
        <form action="{{ route('employer.store') }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="company_name" :required="true">Company Name</x-label>
                <x-text-input name="company_name" :value="old('company_name')" />
            </div>
            <x-button class="w-full">Create</x-button>
        </form>
    </x-card>
</x-layout>