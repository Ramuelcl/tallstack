<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class compEstado extends Component
{
    public $estado;
    /**
     * Create a new component instance.
     */
    public function __construct($valor = 0, $tipo = "activo-inactivo")
    {
        switch ($tipo) {
            case 'si-no':
                $this->estado = $valor  ? 'si'  : 'no';
                break;
            case 'yes-no':
                $this->estado = $valor  ?  'yes' : 'no';
                break;
            case 'on-off':
                $this->estado = $valor  ?  'on' : 'off';
                break;
            case 'true-false':
                $this->estado = $valor  ?  'true' : 'false';
                break;
            default:
                $this->estado = $valor  ?  'activo' : 'inactivo';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.comp-estado');
    }
}
