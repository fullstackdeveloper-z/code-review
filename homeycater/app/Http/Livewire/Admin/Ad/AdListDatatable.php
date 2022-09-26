<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class AdListDatatable extends Component
{
    use WithPagination;

    public $filtering  = true;
    public $length = 10;
    public $order = [ 'created_at' => 'desc' ];
    public $search;
    public $deleteId = '';

    public function render()
    {
        $query = Ad::query();
        if($this->search) {
            $query->where(function(Builder $query) {
                $query->where('first_name', 'LIKE', "%$this->search%")
                    ->orWhere('last_name', 'LIKE'. "%$this->search%")
                    ->orWhere('company', 'LIKE'. "%$this->search%")
                    ->orWhere('type_of_business', 'LIKE'. "%$this->search%")
                    ->orWhere('publish_start_date', 'LIKE'. "%$this->search%")
                    ->orWhere('publish_end_date', 'LIKE'. "%$this->search%")
                    ->orWhere('duration', 'LIKE'. "%$this->search%")
                    ->orWhere('address', 'LIKE'. "%$this->search%")
                    ->orWhere('city', 'LIKE'. "%$this->search%")
                    ->orWhere('state', 'LIKE'. "%$this->search%")
                    ->orWhere('country', 'LIKE'. "%$this->search%")
                    ->orWhere('phone', 'LIKE'. "%$this->search%")
                    ->orWhere('email', 'LIKE'. "%$this->search%")
                    ->orWhere('im_id', 'LIKE'. "%$this->search%")
                    ->orWhere('comments', 'LIKE'. "%$this->search%")
                    ->orWhere('url', 'LIKE'. "%$this->search%")
                    ->orWhere('type', 'LIKE'. "%$this->search%")
                ;
            });
        }

        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        $ads = $query->with('adable')->paginate($this->length);
        $ads->setPath(route('admin.ads.lists'));

        // dd($ads);
        return view('livewire.admin.ad.ad-list-datatable', compact('ads'));
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
        Ad::findOrFail($this->deleteId)->delete();
    }

    public function updatePublishStatus($id,$publish_status) {
        //dd($id,$publish_status);
        $ad = Ad::find($id);
        $ad->published=$publish_status ? "0" :"1";
        $ad->save();
        $this->resetPage();
    }
}
