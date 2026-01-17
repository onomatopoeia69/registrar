@props([
    'id',
    'title' => '',
    'size' => '',
    'noClick' => false
])

<div
    class="modal fade" 
    id="{{ $id }}"
    tabindex="-1"
    wire:ignore
    
    @if($noClick)
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    @endif
>
    <div class="modal-dialog {{ $size }}" >
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">{{ $title }}</h5>
                <button class="btn-close" wire:model="close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               {{ $slot }}
            </div>
        </div>
    </div>
</div>
