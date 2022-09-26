<?php

namespace App\Http\Livewire\Admin\FoodDish;

use Livewire\Component;

class FoodDishLists extends Component
{
    public function render()
    {
        return view('livewire.admin.food-dish.food-dish-lists')->extends('admin.layouts');
    }
}
