@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-300 focus:border-lime-500 focus:ring-lime-500 accent-lime-500 caret-purple-500 outline-lime-500 text-skin-secondary rounded-md shadow-sm',
]) !!}>
