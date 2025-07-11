<div>
    @if ($isFull)
        <div class="mb-1 text-semibold">{{ $name }}</div>
        <label for="{{ $name }}" class="flex gap-2 items-center">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name))/>
            <span>All</span>
        </label>
    @endif
    @foreach($optionsWithLabels as $label => $option)
        <label for="{{ $name }}" class="flex gap-2 items-center">
            <input type="radio" name="{{ $name }}" value="{{ $option }}" @checked(($value?? request($name)) === $option)/>
            <span>{{ $label }}</span>
        </label>
    @endforeach
    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>