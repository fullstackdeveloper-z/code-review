<?php

namespace App\Http\Livewire\Admin\FoodDish;

use Livewire\Component;

class FoodDishAdd extends Component
{
    public function render()
    {
        return view('livewire.admin.food-dish.food-dish-add')->extends('admin.layouts');
    }
}
