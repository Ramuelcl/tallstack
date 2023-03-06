<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
// use Livewire\TemporaryUploadedFile;
// use Illuminate\Support\Facades\Storage;

// use Livewire\WithFileUploads;

class inputPhoto extends Component
{
    // use WithFileUploads;

    public $idName, $label, $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct(string $idName, string $label = '', string $placeholder = '')
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-photo');
    }

    // copiar a php que lo valla a utilizar
    // public function loadImage(TemporaryUploadedFile $image)
    // {
    //     $dir = "avatars";
    //     $path = $dir . "/" . $image->getClientOriginalName();

    //     $path = Storage::disk('public')->put($dir, $image);
    //     // dump($path);
    //     return $path;
    // }
}
