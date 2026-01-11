<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


new
#[Layout('layouts.guest')]
#[Title('Registrar')]
class extends Component
{


 

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
                            <input type="email" class="form-control" placeholder="admin@admin">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-1">
                            <input type="password" class="form-control" placeholder="password">
                            <label for="floatingInput">Password</label>
                        </div>
                        <div class="mb-3 text-end">
                            <a href="" class="small text-decoration-none">Forgot Password?</a>
                        </div>
                        <button type="submit"  class="btn btn-primary w-100 p-2">Login</button>
                </form>

            </div>
        </div>
    </div>
</div>


<script>



// gsap for animation

  const tl = gsap.timeline();

        tl.from("#desc1", { 
            y: -10, 
            opacity: 0, 
            duration: 1, 
            ease: "power2.out" 
        }) 
        .from("#desc2", { 
            y: -10, 
            opacity: 0, 
            duration: 1, 
            ease: "power2.out" 
        })

        .from("#loginform", { 
            y: -10, 
            opacity: 0, 
            duration: 1, 
            ease: "power2.out" 
        });
            

</script>