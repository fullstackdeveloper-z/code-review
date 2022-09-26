<?php

namespace App\Http\Livewire\Admin\FoodCategory;

use Livewire\Component;
use App\Models\FoodCategory;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class FoodCategoryDatatable extends Component
{
    use WithPagination;
    public $filtering  = true;
    public $length = 10;
    public $order = [ 'position' => 'asc' ];
    public $search;
    public $deleteId;
    public function filter() {
        $this->filtering = !$this->filtering;
    }
  
    public function render()
    {
        $query = FoodCategory::query();

        if($this->search) {
            $query->where(function(Builder $query) {
                $query->where('name', 'like', "%$this->search%")
                    ->orWhere('image', 'like', "%$this->search%")
                    ->orWhere('slug', 'like', "%$this->search%")
                    ->orWhere('tags', 'like', "%$this->search%")
                    ->orWhere('description', 'like', "%$this->search%");
            });
        }
        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $foodCategories = $query->paginate($this->length);
        $foodCategories->setPath(route('admin.food.category.lists'));
        
        return view('livewire.admin.food-category.food-category-datatable', compact('foodCategories'));
    }
    
    public function sort(string $column, $direction) {
        if($direction) {
            $this->order[$column] = $direction;
        } else {
            unset($this->order[$column]);
        }

        $this->resetPage();
    }

    public function updatingLength() {
        $this->resetPage();
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function deleteId($id) {
        $this->deleteId = $id;
    }

    public function destroy() {
        $cate = FoodCategory::where('id', $this->deleteId);
        $cate->delete();
        $this->deleteId = null;
        $this->resetPage();
    }

 
}
