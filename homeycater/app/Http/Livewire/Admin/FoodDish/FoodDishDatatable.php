<?php

namespace App\Http\Livewire\Admin\FoodDish;

use App\Models\FoodDish;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class FoodDishDatatable extends Component
{
    use WithPagination;

    public $deleteId = '';

    public $filtering  = true;
    public $length = 10;
    public $order = [ 'created_at' => 'desc' ];
    public $search;

    public function render()
    {
        $query = FoodDish::query();
        if($this->search) {
            $query->where(function(Builder $query) {
                $query->where('name', 'LIKE', "%$this->search%")
                    ->orWhere('color', 'LIKE'. "%$this->search%")
                    ->orWhere('description', 'LIKE'. "%$this->search%")
                ;
            });
        }

        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        $dishes = $query->with('category')->paginate($this->length);
        $dishes->setPath(route('admin.food.dishes.lists'));
        return view('livewire.admin.food-dish.food-dish-datatable', compact('dishes'));
    }

    public function sort(string $column, $direction) {
        if($direction) {
            $this->order[$column] = $direction;
        }else {
            unset($this->order[$column]);
        }
        $this->resetPage();
    }

    public function filter() {
        $this->filtering = !$this->filtering;
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
        FoodDish::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->resetPage();
    }
}
