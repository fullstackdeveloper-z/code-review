<?php

namespace App\Http\Livewire\Admin\FoodCategory;

use App\Models\FoodCategory;
use Livewire\Component;

class FoodCategoryUpdate extends Component
{
    public $foodCategory;
    public function mount(FoodCategory $foodCategory) {
        $this->foodCategory = $foodCategory;
    }

    public function render()
    {
        return view('livewire.admin.food-category.food-category-update')->extends('admin.layouts');
    }
}
