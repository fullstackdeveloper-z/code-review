<?php

namespace App\Http\Livewire\Admin\FoodDish;

use App\Models\FoodDish;
use Livewire\Component;

class FoodDishUpdate extends Component
{
    public $foodDish;
    public function mount(FoodDish $foodDish) {
        $this->foodDish = $foodDish;
    }

    public function render()
    {
        return view('livewire.admin.food-dish.food-dish-update')->extends('admin.layouts');
    }
}
