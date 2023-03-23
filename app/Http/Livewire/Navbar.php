<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public $menus = [
        'Home' => 'pages.index',
        // 'Welcome' => 'pages.welcome',
        'Users' => 'users.usersIndex',
        // 'Roles' => 'users.rolesIndex',
        // 'Permissions' => 'users.permissionsIndex',
        'About' => 'pages.about',
        // 'Master' => 'pages.master',
        'Banca' => 'banca.index',
        'Banca-export' => 'banca.export',
        'Banca-import' => 'banca.import',
        'Banca-archivado' => 'banca.archivado',
        'Banca-relacion_mov' => 'banca.relacion_mov',
        // 'pRuEbAs' => 'pages.pruebas',
    ];

    public function render()
    {
        // dd($this->menus);
        return view(
            'livewire.navbar',
            ['menus' => $this->menus]
        );
    }
}
