<?php

namespace App\Http\Livewire\Admin\Ad;

use Livewire\Component;

class AdList extends Component
{
    public function render()
    {
        return view('livewire.admin.ad.ad-list')->extends('admin.layouts');
    }
}
