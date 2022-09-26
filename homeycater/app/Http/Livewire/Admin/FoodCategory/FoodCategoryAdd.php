<?php

namespace App\Http\Livewire\Admin\FoodCategory;

use Livewire\Component;

class FoodCategoryAdd extends Component
{


    public function render()
    {
        return view('livewire.admin.food-category.food-category-add')->extends('admin.layouts')->section('content');
    }
}
