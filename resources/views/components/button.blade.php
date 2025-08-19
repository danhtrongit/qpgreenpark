@if($url)
    <a
        href="{{ $url }}"
        target="{{ $getTarget() }}"
        @if($newTab) rel="{{ $getRel() }}" @endif
        class="{{ $getClasses() }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </a>
@else
    <button
        type="button"
        class="{{ $getClasses() }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </button>
@endif