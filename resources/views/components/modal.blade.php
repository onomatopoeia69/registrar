@props([
    'id',
    'size' => '',
    'noClick' => false
])

<div
    class="modal fade" 
    id="{{ $id }}"
    tabindex="-1"
    wire:ignore
    style="z-index: 9999;"
    
    @if($noClick)
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    @endif

>
 <div class="modal-dialog {{ $size }}" >
     <div class="modal-content">
            
               {{ $slot }}

     </div>
    </div>
</div>
