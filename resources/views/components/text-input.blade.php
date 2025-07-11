<div class="relative">
    @if($type != 'textarea')
        @if($formRef)
            <div class="absolute top-0 right-0 h-full flex items-center pr-2 cursor-pointer" @click="$refs['{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        @endif
        <input type="{{ $type }}" x-ref="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeHolder }}" id="{{ $name }}" {{ $attributes->class(['w-full round-md border-0 ring-1 text-sm bg-white px-2.5 py-1.5 placeholder:text-slate-400 focus:ring-slate-600', 'pr-8' => $formRef, 'ring-slate-200' => !$errors->has($name), 'ring-red-300' => $errors->has($name)]) }} />
    @else
        <textarea id="{{ $name }}" name="{{ $name }}" {{ $attributes->class(['w-full round-md border-0 ring-1 text-sm bg-white px-2.5 py-1.5 placeholder:text-slate-400 focus:ring-slate-600', 'ring-slate-200' => !$errors->has($name), 'ring-red-300' => $errors->has($name)]) }}>
            {{ old($name, $value) }}
        </textarea>
    @endif
    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>