<?php

namespace App\Http\Livewire\Admin\Cater;

use Livewire\Component;

class CaterAdd extends Component
{
    public function render()
    {
        return view('livewire.admin.cater.cater-add')->extends('admin.layouts');
    }
}
