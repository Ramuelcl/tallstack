<?php
// Application Laravel et Livewire - Flash messages (Nord Coders)

namespace App\Http\Livewire;

use Livewire\Component;

class Flash extends Component
{
    protected $listeners = ['flash' => 'fncSetMessage'];
    public $mensaje, $tipo, $link;
    public $bgColor, $textColor1, $textColor2, $borderColor, $hoverColor, $focusColor,
        $bgColorDark, $textColorDark, $hoverColorDark;

    public function render()
    {
        return view('livewire.flash');
    }

    public function fncSetMessage($mensaje, $tipo = 'success', $link = null)
    {
        $this->mensaje = $mensaje;
        $this->tipo = $tipo;
        $this->link = $link;

        switch ($this->tipo) {
            case 'error':
                $this->bgColor = 'bg-red-100';
                $this->textColor1 = 'text-red-800';
                $this->textColor2 = 'text-red-500';
                $this->borderColor = 'border-red-800';
                $this->focusColor = 'ring-red-400';
                $this->hoverColor = 'bg-red-200';

                $this->bgColorDark = 'bg-gray-800';
                $this->textColorDark = 'text-red-400';
                $this->hoverColorDark = 'bg-gray-700';

                break;

            case 'info':
                $this->bgColor = 'bg-blue-100';
                $this->textColor1 = 'text-blue-800';
                $this->textColor2 = 'text-blue-500';
                $this->borderColor = 'border-blue-800';
                $this->focusColor = 'ring-blue-400';
                $this->hoverColor = 'bg-blue-200';

                $this->bgColorDark = 'bg-gray-800';
                $this->textColorDark = 'text-blue-400';
                $this->hoverColorDark = 'bg-gray-700';

                break;

            case 'atention':
                $this->bgColor = 'bg-yellow-100';
                $this->textColor1 = 'text-yellow-800';
                $this->textColor2 = 'text-yellow-500';
                $this->borderColor = 'border-yellow-800';
                $this->focusColor = 'ring-yellow-400';
                $this->hoverColor = 'bg-yellow-200';

                $this->bgColorDark = 'bg-gray-800';
                $this->textColorDark = 'text-yellow-400';
                $this->hoverColorDark = 'bg-gray-700';

                break;

            case 'dark':
                $this->bgColor = 'bg-gray-100';
                $this->textColor1 = 'text-gray-800';
                $this->textColor2 = 'text-gray-800';
                $this->borderColor = 'border-gray-800';
                $this->focusColor = 'ring-gray-400';
                $this->hoverColor = 'bg-gray-200';

                $this->bgColorDark = 'bg-gray-800';
                $this->textColorDark = 'text-gray-300';
                $this->hoverColorDark = 'bg-gray-100';

                break;

            default: // success
                $this->bgColor = 'bg-green-100';
                $this->textColor1 = 'text-green-800';
                $this->textColor2 = 'text-green-500';
                $this->borderColor = 'border-green-800';
                $this->focusColor = 'ring-green-400';
                $this->hoverColor = 'bg-green-200';

                $this->bgColorDark = 'bg-gray-800';
                $this->textColorDark = 'text-green-400';
                $this->hoverColorDark = 'bg-gray-700';
        }

        $this->dispatchBrowserEvent('flash-message', ['message' => $this->mensaje]);
    }
}
