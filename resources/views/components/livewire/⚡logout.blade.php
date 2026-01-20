<?php

use Livewire\Component;

new class extends Component
{
  public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

         return $this->redirectRoute('registrar.login', navigate:true);
    }
};
?>

<div>

   <a class="nav-link" wire:click='logout' style="cursor: pointer">
        <i class="fa fa-fw fa-power-off text-red"></i>
        {{ __('adminlte::adminlte.log_out') }}
    </a>

</div>