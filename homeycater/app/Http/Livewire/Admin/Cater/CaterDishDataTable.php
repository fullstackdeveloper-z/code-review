<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\CaterMenu;
use App\Models\FoodDish;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CaterDishDataTable extends Component
{
    use WithPagination;
    public $userDish, $rate, $front=false;

    public function saveDish() {
        $this->validate([
            'userDish' => 'required',
            'rate' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ], [
            'userDish.required' => 'please select a dish',
            'rate.required' => 'please enter rate amount',
            'rate.regex' => 'only enter the numbers'
        ]);

        $menu = ['user_id' => $this->userId, "food_dish_id" => $this->userDish, 'rate' => $this->rate];
        CaterMenu::create($menu);
       
        session()->flash('success', 'dish added successfully.');
        if($this->front){
            return redirect()->route('web.user.profile');
        }else{
            return redirect()->route('admin.caters.view', $this->userId);
        }
       
    }

    public $userId;

    public $deleteId = '';

    public $filtering  = true;
    public $length = 10;
    public $order = [ 'created_at' => 'desc' ];
    public $search;

    public $foodDishes;

    public function mount() {

    }
    public function render()
    {
        $query = CaterMenu::where('user_id', $this->userId);
        if($this->search) {
            $query->where(function(Builder $query) {
                    $query->where('rate', 'LIKE', "%$this->search%")
                    ->orWhereHas('dish', function(Builder $query) {
                        $query->where('name','LIKE', "%$this->search%");
                     });
            });
        }

        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $dishes = $query->with('dish')->paginate($this->length);
        $dishes->setPath(route('admin.caters.view',$this->userId));

        $this->foodDishes = FoodDish::orderBy('name', 'asc')->whereNotIn('id', $dishes->pluck('food_dish_id')->toArray())->get();

        return view('livewire.admin.cater.cater-dish-data-table', compact('dishes'));
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
        CaterMenu::findOrFail($this->deleteId)->delete();
    }
}
