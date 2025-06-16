@props([
    'name',
    'label' => null,
    'type' => 'text',
    'renderOldValue' => true,
])

@if($label)
    <label for="{{ $name }}" class="text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
@endif
<input id="{{ $name }}"
       name="{{ $name }}"
       type="{{ $type }}"
       @if($renderOldValue)
           value="{{ old($name) }}"
       @endif
       {{ $attributes }}
       class="block w-full p-2 border rounded-md shadow-sm
                   focus:ring-primary-500 focus:border-primary-500">
@error($name)
<span class="text-sm text-red-500">{{ $message }}</span>
@enderror
