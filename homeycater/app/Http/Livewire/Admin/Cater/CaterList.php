<?php

namespace App\Http\Livewire\Admin\Cater;

use Livewire\Component;

class CaterList extends Component
{
    public function render()
    {

        return view('livewire.admin.cater.cater-list')->extends('admin.layouts');
    }
}
