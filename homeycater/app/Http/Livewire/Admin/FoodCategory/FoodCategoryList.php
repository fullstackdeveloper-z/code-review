<?php

namespace App\Http\Livewire\Admin\FoodCategory;

use App\Models\FoodCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class FoodCategoryList extends Component
{
    use WithPagination;

    public function render()
    {

        return view('livewire.admin.food-category.food-category-list')->extends('admin.layouts');
    }




}
