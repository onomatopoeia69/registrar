<?php

use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


new
#[Layout('layouts.guest')]
#[Title('Registrar')]
class extends Component
{
  #[Validate('required|email',as: 'email')]
    public $username = '';

   #[Validate('required')]
    public $password = '';

    public function login()
    {       
       $this->validate();   
    }

    public function resetFields()
    {
     $this->resetErrorBag();
    }



};

?>


<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        <div  class="col-md-6 d-none d-md-flex bg-primary align-items-center justify-content-center text-white">
            <div class="text-center p-5">
                <h1 class="display-4 fw-bold" id="desc1" >Registrar System</h1>
                <p class="lead" id="desc2">Managing student records with ease and intelligence.</p>
            </div>
            
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="p-5 w-100"  style="max-width: 450px;">
                
                <form wire:submit="login" id="loginform">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control  @error('username') is-invalid   @else  @if(!empty($username))  @endif @enderror shadow-lg" wire:model='username' placeholder="admin@admin">
                            <label for="floatingInput">Email address</label>
                             @error('username')
                                <div  class="invalid-feedback" wire:transition>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-1">
                            <input type="password" class="form-control shadow-lg @error('password') is-invalid   @else  @if(!empty($password))  @endif @enderror" wire:model='password' placeholder="password">
                            <label for="floatingInput">Password</label>
                             @error('password')
                                <div  class="invalid-feedback" wire:transition>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-end">
                            <a href="" class="small text-decoration-none">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 p-2 shadow-lg">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>



// gsap for animation
  const tl = gsap.timeline();

        tl.from(["#desc1", "#desc2", "#loginform"], { 
            y: -10, 
            opacity: 0, 
            duration: 1, 
            stagger: 0.4, 
            ease: "power2.out" 
        });

// clear the errors when any field clicked 
    const inputFields = document.querySelectorAll('input') 
        inputFields.forEach( input =>{
            input.addEventListener('click',()=>{
                $wire.resetFields();
            });
        });
 
  

</script>
