<?php

namespace App\Http\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = "admin@foodlist.com";
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
    public function render()
    {
        // dd($this->email, $this->password);
        return view('livewire.admin.auth.login')
            ->extends('layouts.empty-layout')
            ->section('content');
    }
    public function login() {
        $this->validate();

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password, 'user_type' => 'admin'])) {
            return redirect(route('admin.dashboard'));//->with(['res' => true, 'msg' => "Welcome to admin dashboard"]);
        } else {
            session()->flash('message', 'your records does not match.');
        }
    }


}
