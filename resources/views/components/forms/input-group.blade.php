@props(['id', 'label', 'name', 'type', 'placeholder'])

@if($type !== 'radio')
    <label for="{{ $id }}" class="block text-gray-700 text-base font-bold mb-2">{{ $label }}</label>
@endif

@if($type === 'textarea')
    <textarea 
        name="{{ $name }}" 
        class="rounded-md border-transparent bg-slate-200 w-full focus:outline-none focus:shadow-outline" 
        id="{{ $id }}" 
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        {{ $attributes }}></textarea>

@elseif($type === 'radio')
    <div class="flex items-center mb-2">
        <input 
            id="{{ $id }}" 
            type="{{ $type }}" 
            name="{{ $name }}" 
            class="mr-2 checked:bg-no-repeat checked:bg-center checked:border-indigo-500 checked:bg-indigo-100"
            {{ $attributes }}/>
        <label 
            for="{{ $id }}" 
            class="flex items-center cursor-pointer text-gray-600 text-sm font-normal">{{ $label }}
        </label>
    </div>

@elseif($type === 'date')
    <input 
        type="{{ $type }}" 
        class="rounded-md border-transparent bg-slate-200 w-full focus:outline-none focus:shadow-outline"
        name="{{ $name }}" 
        id="{{ $id }}" 
        {{ $attributes }}
    />

@else
    <input 
        type="{{ $type }}" 
        class="rounded-md border-transparent bg-slate-200 w-full focus:outline-none focus:shadow-outline"
        name="{{ $name }}" 
        id="{{ $id }}" 
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        {{ $attributes }}
    />
@endif

{{ $slot ?? '' }}
