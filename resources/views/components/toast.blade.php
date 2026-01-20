@props([
    'id',
    'color' => 'success',
    'text' => 'white',
    'time' => '',
])

<div id="{{ $id }}"
     class="toast"
     role="alert"
     aria-live="assertive"
     aria-atomic="true"
     wire:ignore
     >

    <div class="toast-header bg-{{ $color }} border-0 text-{{ $text }} ">
        <i class="bi bi-bell-fill me-2"></i>
        <strong class="me-auto">Notification</strong>
        <small>{{ $time }}</small>

        <button type="button"
                class="btn-close btn-close-white ms-2"
                data-bs-dismiss="toast"
                aria-label="Close">
        </button>
    </div>

    <div class="toast-body">
        {{ $slot }}
    </div>
</div>
