<?php

namespace App\Http\Livewire\Admin\Contact;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

use Livewire\Component;

class ContactListDatatable extends Component
{   
    use WithPagination;
    public $filtering  = true;
    public $length = 10;
    public $order = [ 'created_at' => 'asc' ];
    public $search;

    public $deleteId;

    public function filter() {
        $this->filtering = !$this->filtering;
    }


    public function render()
    {   
        $query = Contact::query();
        if($this->search) {
            $query->where(function(Builder $query) {
                $query->where('name', 'like', "%$this->search%")
                    ->orWhere('email', 'like', "%$this->search%")
                    ->orWhere('phone', 'like', "%$this->search%")
                    ->orWhere('message', 'like', "%$this->search%");   
            });
        }
        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        $contacts = $query->paginate($this->length);
        $contacts->setPath(route('admin.contact.lists'));
        return view('livewire.admin.contact.contact-list-datatable',compact('contacts'));
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
        $cate = Contact::where('id', $this->deleteId);
        $cate->delete();
        $this->deleteId = null;
        $this->resetPage();
    }
}
