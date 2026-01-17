<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new 
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
class extends Component
{
    //
};
?>

<div class="container-fluid pt-4">
    <x-adminlte-card  title="Welcome" theme="primary" icon="fas fa-lg fa-fan">
        Hello! This is a Livewire component inside AdminLTE.
        <button wire:click="someAction" class="btn btn-success">Click Me</button>
    </x-adminlte-card>
</div>