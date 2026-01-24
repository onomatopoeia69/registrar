@props([
    'id',
    'color' => 'success',
    'text' => 'white',
    'time' => '',
])


<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
  <div id={{ $id }}
   class="toast hide"
    role="alert" 
    aria-live="assertive"
     aria-atomic="true" 
     data-delay="3000">
     
    <div class="toast-header bg-{{ $color }} border-0 text-{{ $text }}">
      <i class="fas fa-bell mr-2 text-white"></i>
      <strong class="mr-auto">Notification</strong>
      <small>{{ $time }}</small>
    </div>
    <div class="toast-body">
     {{ $slot }}
    </div>
  </div>
</div>
