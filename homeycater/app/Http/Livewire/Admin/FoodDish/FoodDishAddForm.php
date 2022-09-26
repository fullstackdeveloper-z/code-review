<?php

namespace App\Http\Livewire\Admin\FoodDish;

use App\Models\FoodCategory;
use App\Models\FoodDish;
use Livewire\Component;

class FoodDishAddForm extends Component
{
    public $name, $color, $category_id, $description, $tags, $keywords;
    public function render()
    {
        $categories = FoodCategory::orderBy('name', 'asc')->get();
        return view('livewire.admin.food-dish.food-dish-add-form', compact('categories'));
    }

    public function save() {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
            'category_id' => 'required'
        ], [
            'name.required' => 'please enter name',
            'color.required' => 'please enter color',
            'category_id.required' => 'please choose category'
        ]);

        $dish = new FoodDish();
        $dish->name = $this->name;
        $dish->slug = slugify($this->name);
        $dish->color = $this->color;
        $dish->food_category_id = $this->category_id;
        $dish->description = $this->description;
        $dish->tags = $this->tags;
        $dish->keywords = $this->keywords;

        if($dish->save()) {
            session()->flash('success', 'Food Dish created successfully.');

        } else {
            session()->flash('error', 'Food Dish not created successfully.');
        }
        return redirect()->route('admin.food.dishes.lists');
    }
}
