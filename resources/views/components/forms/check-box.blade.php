<div class="flex items-center gap-2">
    <input type="checkbox" id="{{ $id ?? $name . '_' . $value }}" name="{{ $name }}[]" value="{{ $value }}"
        {{ $checked ?? '' }}
        {{ $attributes->merge(['class' => 'w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2']) }}>
    <label for="{{ $id ?? $name . '_' . $value }}" class="text-sm font-medium text-gray-700">{{ $label }}</label>
</div>
