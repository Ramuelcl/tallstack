<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\Livewire;

class cargaliveController extends Controller
{
    public function usersIndex()
    {
        return view('backend.usersIndex');
    }
    public function rolesIndex()
    {
        return view('backend.rolesIndex');
    }
    public function permissionsIndex()
    {
        return view('backend.permissionsIndex');
    }
}
