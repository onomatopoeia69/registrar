<?php

use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;


new
#[Layout('layouts.registrar.login',[ 'title' => 'Login'])]

class extends Component
{
  #[Validate('required|email')]
    public $email = '';
  #[Validate('required')]
    public $password = '';

    public function login()
    {
        
        $this->validate(); 

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (!Auth::attempt($credentials)) {

            throw ValidationException::withMessages([
                 'InvalidCredentials' => 'The provided credentials are incorrect.',
             ]);
        }

         $this->reset();

        $user = Auth::user();


        session()->flash('welcome', 'Welcome back!');
        session()->flash( 'time', now()->diffForHumans());
        

        switch ($user->role) {
            case 'registrar':
                return $this->redirectRoute('registrar.dashboard', navigate:true);
                // return redirect()->route('registrar.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
               session()->flash( 'emailVerified', Auth::user()->is_email_verified);
                return redirect()->route('users.dashboard');
            }

    }



    public function resetFields()
    {
        $this->resetErrorBag();
    }

    public function modal()
    {

        $this->dispatch('open-modal', id: 'forgetPassModal');

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
                            <input type="email" class="form-control  @error('email') is-invalid   @else  @if(!empty($username))  @endif @enderror shadow-lg" wire:model='email' placeholder="admin@admin">
                            <label for="floatingInput">Email address</label>
                             @error('email')
                                <div  class="invalid-feedback" wire:transition>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-1" >
                            <input type="password" id="loginPassword" class="form-control shadow-lg @error('password') is-invalid   @else  @if(!empty($password))  @endif @enderror" wire:model.defer='password' placeholder="password">
                            <label for="floatingInput">Password</label>
                            <i wire:ignore
                                class="bi bi-eye-fill position-absolute top-50 end-0 translate-middle-y me-3 text-secondary d-none" 
                                id="eyeloginPassword"
                                style="cursor: pointer;">
                            </i>
                             @error('password')
                                <div  class="invalid-feedback" wire:transition>{{ $message }}</div>
                            @enderror
                        </div>

                  
                        <div class="mb-3 text-end">
                            <a class="small text-decoration-none" wire:click='modal' style="cursor: pointer;">Forgot Password?</a>
                        </div>
                         

                        <button type="submit" class="btn btn-primary w-100 p-2 shadow-lg mb-1">Login</button>

                        @error('InvalidCredentials')
                            <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror

                </form>

                <x-modal id='forgetPassModal' size="modal-dialog-centered" noClick=true >

                    <livewire:pages::auth.forgot-pass />
                    
                </x-modal>

            </div>
        </div>
    </div>
</div>



<script>

document.addEventListener('open-modal', e => {
    const modal = new bootstrap.Modal(
        document.getElementById(e.detail.id)
    );
    modal.show();
});



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



// add password eye toggler 

    let eyeBtn = document.querySelector('#eyeloginPassword');
    let passwordInput = document.querySelector('#loginPassword');

    passwordInput.addEventListener('input',(event)=>{

        let input = event.target.value;

        if(input)
        {
            eyeBtn.classList.remove('d-none');
         }else{
            eyeBtn.classList.add('d-none');
        }
    
    });

// button to reveal the input password 

    eyeBtn.addEventListener('click',(event)=>{

        let isPassword = passwordInput.type === 'password' ? true : false;

        if(isPassword)
        {
        passwordInput.type = 'text';
        eyeBtn.classList.remove('bi-eye-fill');
        eyeBtn.classList.add('bi-eye-slash-fill');

        }else{
        passwordInput.type = 'password';
        eyeBtn.classList.remove('bi-eye-slash-fill');
        eyeBtn.classList.add('bi-eye-fill');
        }


    });


   

 

  

</script>
