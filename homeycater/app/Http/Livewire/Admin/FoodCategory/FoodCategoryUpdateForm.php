<?php

namespace App\Http\Livewire\Admin\FoodCategory;

use App\Models\FoodCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class FoodCategoryUpdateForm extends Component
{
    use WithFileUploads;
    public $name, $category_id,  $old_image;
    public $image, $description, $tags, $keywords,$position;
    

    public function mount(FoodCategory $foodCategory) {
        $this->name = $foodCategory->name;
        $this->category_id = $foodCategory->id;
        $this->description = $foodCategory->description;
        $this->tags = $foodCategory->tags;
        $this->keywords = $foodCategory->keywords;
        $this->old_image = $foodCategory->image;
        $this->position = $foodCategory->position;
      
    }

    public function render()
    {
        return view('livewire.admin.food-category.food-category-update-form');
    }

    public function updatedImage() {
        $this->validate([
            'image' => 'exclude_if:image,null|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:ratio=16/9',
        ],[
            'image.mimes' => 'Please choose the image with extension(.jpg,.bmp,.png,.svg,.jpeg)',
            'image.max' => 'Please choose image under size of 2 MB',
            'image.dimensions' => 'Please choose image dimensions ratio 16:9 only'
        ]);
    }

    public function save($id) {
     
        $this->validate([
            'name' => 'required',
            'image' => 'exclude_if:image,null|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:ratio=16/9',
        ],[
            'name.required' => 'Please enter the name (required)',
            'image.mimes' => 'Please choose the image with extension(.jpg,.bmp,.png,.svg,.jpeg)',
            'image.max' => 'Please choose image under size of 2 MB',
            'image.dimensions' => 'Please choose image dimensions ratio 16:9 only'
        ]);

        $cate = FoodCategory::find($id);
        $cate->name = $this->name;
        $cate->slug = slugify($this->name);
        $cate->description = $this->description;
        $cate->tags = $this->tags;
        $cate->keywords = $this->keywords;
        $cate->position = $this->position;

        if(!empty($this->image)) {
            $cate->image = $this->image->store('category', 'public');
        }

        if ($cate->save()) {
            session()->flash('success', 'Category updated successfully.');
            
        } else {
            session()->flash('error', 'Category not updated successfully.');
            
        }
        return redirect()->route('admin.food.category.lists');
    }
}
