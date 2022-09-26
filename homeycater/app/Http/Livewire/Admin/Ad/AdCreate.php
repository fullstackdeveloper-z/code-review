<?php

namespace App\Http\Livewire\Admin\Ad;

use Livewire\Component;

class AdCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.ad.ad-create')->extends('admin.layouts');
    }
}
