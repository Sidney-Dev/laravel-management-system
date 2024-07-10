{{-- resources/views/components/cta/link-primary.blade.php --}}

@props(['text', 'link'])
<a 
    href="{{ $link }}"
    {{ $attributes->merge(['class' => "bg-purple-900 flex text-white rounded-lg py-2 px-4 border-solid border-2 hover:text-purple-900 hover:bg-white hover:border-purple-900"]) }}>
    
    @isset($text)
        {{ $text }}
    @endisset
    {{ $slot }}
</a>