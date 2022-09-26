<?php

namespace App\Http\Livewire\Admin\Contact;

use Livewire\Component;

class ContactList extends Component
{
    public function render()
    {
        return view('livewire.admin.contact.contact-list')->extends('admin.layouts');
    }
}
