<?php

use Livewire\Component;

new class extends Component
{

    public $title = '';

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();

        $this->dispatch('close-modal');
    }

    public function submit()
    {

        dd($this->title);

    }


};
?>

<div>
    <div class="modal-header bg-primary">
        <h5 class="modal-title text-white">Add Event: </h5>
        <button class="btn-close" wire:click="resetFields" data-bs-dismiss="modal"></button>
    </div>
     <div class="modal-body">

    <form wire:submit.prevent="submit">

         <div class="mb-3">
            <label class="form-label">Title</label>
            <input wire:model='title' type="text" class="form-control" id="title" required>
          </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" id="description"></textarea>
          </div>

          <button type="button" class="btn btn-primary">Submit</button>
          
    </form>

    </div>
</div>