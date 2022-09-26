<?php

namespace App\Http\Livewire\Admin\FoodDish;

use App\Models\FoodCategory;
use App\Models\FoodDish;
use Livewire\Component;

class FoodDishUpdateForm extends Component
{   

    public $name, $dish_id,$category_id;
    public $color, $description, $tags, $keywords;
    
    public function mount(FoodDish $foodDish) {
      // dd($foodDish);
        $this->dish_id = $foodDish->id;
        $this->name = $foodDish->name;
        $this->category_id = $foodDish->food_category_id;
        $this->description = $foodDish->description;
        $this->tags = $foodDish->tags;
        $this->keywords = $foodDish->keywords;
        $this->color = $foodDish->color;
      
    }
    public function render()
    {    $categories = FoodCategory::orderBy('name', 'asc')->get();
        return view('livewire.admin.food-dish.food-dish-update-form',compact('categories'));
    }
   
    public function save($id) {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
            'category_id' => 'required'
        ], [
            'name.required' => 'please enter name',
            'color.required' => 'please enter color',
            'category_id.required' => 'please choose category'
        ]);

        $dish = FoodDish::find($id);
        $dish->name = $this->name;
        $dish->slug = slugify($this->name);
        $dish->color = $this->color;
        $dish->food_category_id = $this->category_id;
        $dish->description = $this->description;
        $dish->tags = $this->tags;
        $dish->keywords = $this->keywords;

        if($dish->save()) {
            session()->flash('success', 'Food Dish updated successfully.');

        } else {
            session()->flash('error', 'Food Dish not updated successfully.');
        }
        return redirect()->route('admin.food.dishes.lists');
    }

}
