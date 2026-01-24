<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Component;

new
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
 class extends Component
{   

    use WithFileUploads;

    #[Validate('image|max:5120|mimes:jpg,jpeg,png|required|file')] 
    public $file;

    public $resultText = null;

    public $test= false;

    public function scan()
    {
        $this->validate();

        $imagePath = $this->file->getRealPath();

        $response = Http::attach(
            'file', file_get_contents($imagePath), $this->file->getClientOriginalName()
        )->post('https://api.ocr.space/parse/image', [
            'apikey' => env('OCR_SPACE_API_KEY'),
            'language' => 'eng',
            'isOverlayRequired' => 'false',
            'filetype' => strtoupper($this->file->getClientOriginalExtension()),
        ]);

        $data = $response->json();

        if (isset($data['ParsedResults'][0]['ParsedText'])) {
            $this->resultText = $data['ParsedResults'][0]['ParsedText'];
        } else {
            session()->flash('error', $data['ErrorMessage'][0] ?? 'OCR Failed to read text.');
        }

    }


    
};
?>

<div>

    <section id="file" class="container-fluid pt-4">

    <div class="card">

    <div class="card-header">
        <h1 class="card-title text-bold fs-3">Optical Character Recognition (OCR)</h1>
    </div>

    <div class="mb-3 p-4">
            <form action="" wire:submit.prevent='scan'>
            <label for="formFile" class="form-label">Input Image File: </label>
            <input class="form-control @error('file') is-invalid @enderror" type="file" id="formFile" wire:model='file'>
            @error('file')
                 <div class="invalid-feedback" wire:transition>{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-2 w-100" @disabled(!$file || $errors->has('file'))>Scan</button>
            </form>
     </div>

    
    </section>

    <section id="result" class="container-fluid pt-4">

   <div class="card">
    <div class="card-header">
        <h1 class="card-title text-bold fs-3">Results</h1>
       
            <div class="card-tools @if(!$resultText) d-none @endif" >
                <button type="button" class="btn btn-sm btn-default" id='copyText'">
                    <i class="fas fa-copy"></i> Copy Text
                </button>
            </div>
    </div>

    <div class="card-body">
       
            <pre id="ocrResult" class="@if(!$resultText) d-none @endif"" style="white-space: pre-wrap; font-family: inherit; background: #f8f9fa; padding: 15px; border: 1px solid #ddd;">{{ $resultText }}</pre>
      
            <div class="text-center p-4 @if($resultText) d-none @endif"">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        <i class="icon fas fa-ban"></i> {{ session('error') }}
                    </div>
                @endif
                <span class="text-muted"><i class="fas fa-file-import fa-2x mb-2"></i><br>No Result to display</span>
            </div>
    </div>
</div>
  
    </section>  


    <x-toast id="liveToast">Copied!</x-toast>

</div>

<script>

    let copyTextBtn = document.querySelector('#copyText');
    let icon = copyTextBtn.querySelector('i');
    let result  = document.querySelector('#ocrResult');
   

    copyTextBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(result.textContent);
        icon.classList.replace('fa-copy','bi-clipboard-check-fill');
        $('#liveToast').toast('show');
    });
    


</script>