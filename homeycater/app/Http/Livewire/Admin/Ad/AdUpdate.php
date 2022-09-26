<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use Livewire\Component;


class AdUpdate extends Component
{
    public $ad;

    public function mount(Ad $ad) {
        $this->ad = $ad;
      
    }
    public function render()
    {
        return view('livewire.admin.ad.ad-update')->extends('admin.layouts');
    }
}
