<?php

namespace App\Http\Livewire\Admin\Cater;

use Livewire\Component;
use App\Models\User;
use App\Models\Cater;

class CaterUpdate extends Component
{  
    public $user;
    public function mount($id) {
        $this->user = User::with(['cater','covidDetails'])->find($id);
       
    }

    public function render()
    {
        return view('livewire.admin.cater.cater-update')->extends('admin.layouts');
    }
}
