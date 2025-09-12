@props([
    'name',
    'label',
    'options' => [],
    'required' => false,
    'error' => null,
    'value' => null,
    'help' => null,
    'placeholder' => null,
])

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <select id="{{ $name }}" name="{{ $name }}" @if ($required) required @endif
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($name) border-red-500 @enderror">
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @if ($help)
        <p class="text-sm text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
