@props(['text', 'link'])
<a 
    class="bg-purple-900 text-white rounded-lg py-2 px-4 border-solid border-2 hover:text-purple-900 hover:bg-white hover:border-purple-900" 
    href="{{ $link }}">
    {{ $text }}
</a>