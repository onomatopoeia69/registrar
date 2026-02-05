<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('layouts.registrar.appearance')]
#[Title('Registrar')]
 class extends Component
{
    public function cookies()
    {

        dd(request()->cookie('custom'));

    }
};
?>

<div>
    <section id="info" class="container-fluid pt-4 ">

    <div class="card">

    <div class="card-header">
        <h1 class="card-title text-bold fs-3">Appearance</h1>
    </div>

    <div class="card-body p-4 mt-3">

        <div class="card p-3" style="width: 18rem;">
             <h5 class="card-title mb-2 text-bold">Choose your theme:</h5>
                <div class="card-body">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="radioDefault1" name="theme" value="system-default"  {{ request()->cookie('custom') !== 'true' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioDefault1">
                            System-Default
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="radioDefault2" name="theme" value="custom"  {{ request()->cookie('custom') === 'true' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioDefault2">
                            Custom
                        </label>
                    </div>
            </div>
        </div>

    </div>
    </div>
        
    </section>

    <section id="custom" class="container-fluid pt-4 {{ request()->cookie('custom') === 'true' ? '' : 'visually-hidden' }}">

        <div class="card">

             <div class="card-header">
                <h1 class="card-title text-bold fs-3">Appearance</h1>
            </div>

            <div class="card-body p-4 my-3">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card h-100"> 
                                <h5 class="card-title mx-3 mt-3 text-bold">Sidebar Background: </h5>
                                <div class="card-body">
                                   <input class="jscolor" id="sidebarBG" value="{{request()->cookie('sidebar_bg') ?? '343a40' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <h5 class="card-title mx-3 mt-3 text-bold">Sidebar Brand Link:</h5>
                                <div class="card-body">
                                     <input class="jscolor" id="sidebarBrand" value="{{request()->cookie('sidebar_brand') ?? '343a40' }}">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>


           <div class="text-end mx-3 my-3">
                <button class="btn btn-success" id="saveBtn">Save</button>
            </div>



        </div>
        

    </section>
        
</div>

@script
<script>

const themes = document.querySelectorAll('input[name="theme"]');
const customSec = document.querySelector('#custom');
const saveBtn = document.querySelector('#saveBtn');
const sidebarBg = document.querySelector('#sidebarBG');
const sidebarBrand = document.querySelector('#sidebarBrand');


themes.forEach(radio => {
    radio.addEventListener('change', e => {

        if (e.target.value === 'custom') {
            customSec.classList.remove('visually-hidden');
            document.cookie = "custom=true; path=/; SameSite=Lax";
        } else {
            customSec.classList.add('visually-hidden');
            document.cookie = "custom=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            document.cookie = "sidebar_bg=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            document.cookie = "sidebar_brand=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            location.reload();
        }

    });
});

saveBtn.addEventListener('click', () => {
    const color = sidebarBg.value;
    const brandColor = sidebarBrand.value;
    document.cookie = `sidebar_bg=${color}; path=/; SameSite=Lax`;
    document.cookie = `sidebar_brand=${brandColor}; path=/; SameSite=Lax`;
    location.reload();
});

sidebar_brand

</script>
@endscript