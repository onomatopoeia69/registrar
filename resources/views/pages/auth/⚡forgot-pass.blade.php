<?php

use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{   

    #[Validate('required',as: 'email')]
    public $fgEmail = '';
   
    public function send()
    {
      $this->validate();
    }

    public function resetFields()
    {
      $this->reset();
      $this->resetErrorBag();
    }

};
?>




<div>

     <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Forgot Password?</h5>
                <button class="btn-close" wire:click="resetFields" data-bs-dismiss="modal"></button>
        </div>
     <div class="modal-body">

    <form wire:submit="send">
         <div class="form-floating mb-4">
             <input type="email" class="form-control  @error('fgEmail') is-invalid   @else  @if(!empty($fgEmail))  @endif @enderror shadow-lg" wire:model.live='fgEmail' placeholder="admin@admin">
                            <label for="floatingInput">Email address</label>
                             @error('fgEmail')
                                <div  class="invalid-feedback" wire:transition>{{ $message }}</div>
                            @enderror
             </div>
           <button type="submit" class="btn btn-primary w-100 p-2 shadow-lg">Send</button>
    </form>

    </div>
</div>