<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CaterDatatable extends Component
{
    use WithPagination;
    public $deleteId = '';
    public $filtering  = true;
    public $length = 10;
    public $order = [ 'created_at' => 'desc' ];
    public $search;

    public function render()
    {
        $query = User::where('user_type', 'cater');
        if($this->search) {
            $query->where(function(Builder $query) {
                $query->where('name', 'LIKE', "%$this->search%")
                    ->orWhere('email', 'LIKE'. "%$this->search%")
                    // ->orWhere('description', 'LIKE'. "%$this->search%")
                ;
            });
        }

        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $users = $query->with('cater')->paginate($this->length);
        $users->setPath(route('admin.caters.lists'));
        
        return view('livewire.admin.cater.cater-datatable', compact('users'));
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
        User::findOrFail($this->deleteId)->delete();
    }
}
