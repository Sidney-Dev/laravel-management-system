@props(['icon', 'title', 'route' => '#', 'dropdown' => false])

<li class="parent-menuitem px-4 py-2 text-lg font-medium">
    <div class="flex items-center justify-between cursor-pointer" onclick="toggleDropdown(this)">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                {!! $icon !!}
            </svg>
            <span>{{ $title }}</span>
        </div>
        @if ($dropdown)
            <x-icons.dropdown-icon class="dropdown-icon" />
        @endif
    </div>
    @if ($dropdown)
        <ul class="collapsed-item ml-7 text-base hidden transition-all duration-300 ease-in-out overflow-hidden">
            {{ $slot }}
        </ul>
    @endif
</li>
