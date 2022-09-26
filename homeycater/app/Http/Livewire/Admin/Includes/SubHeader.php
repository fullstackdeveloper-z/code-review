<?php

namespace App\Http\Livewire\Admin\Includes;

use Livewire\Component;

class SubHeader extends Component
{
    public $text;
    public $addButton;

    public function mount($text, $addButton=null)
    {
        $this->text = $text;
        $this->addButton = $addButton;
    }

    public function render()
    {
        return view('livewire.admin.includes.sub-header');
    }
}
