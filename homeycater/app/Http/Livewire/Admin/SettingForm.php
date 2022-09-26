<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class SettingForm extends Component
{
    public $sidebar_ads;

    public function mount() {
        $setting = Setting::query()->first();
        $this->sidebar_ads = $setting->sidebar_ads;

    }
    public function render()
    {
        return view('livewire.admin.setting-form');
    }

    public function save() {

        $this->validate([
            'sidebar_ads' => 'required|numeric',
        ],[
            'name.required' => 'Please enter the ads number (required)',
            'name.numeric' => 'Please enter the ads number (required)',
        ]);

        $setting = Setting::query()->first();
        $setting->sidebar_ads = $this->sidebar_ads;

        if ($setting->save()) {
            session()->flash('success', 'Ads Setting updated successfully.');

        } else {
            session()->flash('error', 'Ads Setting not updated successfully.');

        }
        return redirect()->route('admin.ads.setting');
    }
}
