<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\User;
use Livewire\Component;

class CaterView extends Component
{
    public $user;

    public function mount($id) {
        $this->user = User::findOrFail($id);
    }
    public function render()
    {
        $this->user->load(['cater', 'covidDetails']);
        // dd($this->user);
        return view('livewire.admin.cater.cater-view')->extends('admin.layouts');
    }
}
