{{-- resources/views/components/cta/button-primary.blade.php --}}
{{--   --}}
@props(['text'])
<button 
    type="submit" 
    {{ $attributes->merge(['class' => "bg-purple-900 rounded-lg text-white py-2 px-4 border-solid border-2 hover:text-purple-900 hover:bg-white hover:border-purple-900"]) }}>
    
    @isset($text)
        {{ $text }}
    @endisset
    {{ $slot }}
</button>