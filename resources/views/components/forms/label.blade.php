@props(['id', 'label'])

<label for="{{ $id }}" {{ $attributes->merge(['class' => "block text-gray-700 text-base font-bold mb-2"])}}>{{ $label }}</label>
