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

<div>

    <section id="box-info1" class="container-fluid pt-4">
    <div class="card p-2">

    <div class="card-header">
        <h1 class="card-title text-bold fs-3">Students</h1>
    </div>

    <div class="card-body p-2"> 

        <div class="mb-3 p-2 d-flex align-items-center gap-2">

                <div class="text-bold">
                    <span>Import to:</span>
                </div>
               
                <div>
                 <button type="button" class="btn btn-danger">
                    <i class="fas bi-file-earmark-pdf-fill"></i>
                    PDF
                </button>

                 <button type="button" class="btn btn-success">
                    <i class="fas bi-file-earmark-excel-fill"></i>
                    Excel
                </button>

                 <button type="button" class="btn btn-primary">
                    <i class="fas bi-filetype-csv"></i>
                    CSV
                </button>


                </div>
               
              
        </div>
       

      <x-adminlte-datatable id="table1" class='p-4' :heads="['ID', 'Name', 'Email', 'Actions']"  head-theme="light"
      >
      
            <tr>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>
             <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>

              <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>worl</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>dawdad</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>  <tr>
                <td>dawdawd</td>
                <td>test</td>
                <td>test</td>
                <td>...</td>
            </tr>

            
      
    </x-adminlte-datatable>
    </div>
    </div>

    </section>

</div>