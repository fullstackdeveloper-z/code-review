<?php

namespace App\Http\Livewire\Admin\Contact;
use App\Models\Contact;
use Livewire\Component;

class ContactView extends Component
{   
    public $contact;
    public function mount($id)
    {
        $this->contact = Contact::findOrFail($id);
       
    }
    public function render()
    {   
       // $data = $this->contact;
        return view('livewire.admin.contact.contact-view')->extends('admin.layouts');
    }
}
