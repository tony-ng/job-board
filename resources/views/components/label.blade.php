<label for="{{ $for }}" {{ $attributes->class(['block mb-2 font-medium text-sm text-slate-700']) }}>
    {{ $slot }}
    @if ($required)
        <span>*</span>
    @endif
</label>