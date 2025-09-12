@props([
    'name',
    'label',
    'type' => 'text',
    'required' => false,
    'error' => null,
    'value' => null,
    'placeholder' => null,
    'help' => null,
])

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($required) required @endif
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($name) border-red-500 @enderror">

    @if ($help)
        <p class="text-sm text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
