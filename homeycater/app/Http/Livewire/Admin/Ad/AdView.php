<?php

namespace App\Http\Livewire\Admin\Ad;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Photo;
use App\Models\Video;

class AdView extends Component
{   
    public $ad;
    public $adable_data;
    public function mount($id)
    {
        $this->ad = Ad::findOrFail($id);
        if($this->ad->adable_type == 'App\Models\Photo') {
           $this->adable_data = Photo::find($this->ad->adable_id);
        }else{
            $this->adable_data = Video::find($this->ad->adable_id);
        }
        //$this->adable_data='adable data';
      
    }

    public function render()
    {
        return view('livewire.admin.ad.ad-view')->extends('admin.layouts');
    }
}
