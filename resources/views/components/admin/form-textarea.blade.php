@props([
    'name',
    'label',
    'required' => false,
    'error' => null,
    'value' => null,
    'placeholder' => null,
    'help' => null,
    'rows' => 4,
])

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($required) required @endif
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($name) border-red-500 @enderror">{{ old($name, $value) }}</textarea>

    @if ($help)
        <p class="text-sm text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
