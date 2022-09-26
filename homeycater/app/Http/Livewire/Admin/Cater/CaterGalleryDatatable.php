<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\CaterGallery;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CaterGalleryDatatable extends Component
{
    use WithPagination, WithFileUploads;
    public $image, $status='published';



    public $userId;

    public $deleteId = '';

    public $filtering  = true;
    public $length = 10;
    public $order = [ 'created_at' => 'desc' ];
    public $search;
    public $front=false; 
    public $foodDishes;

    public function mount() {

    }
    public function render()
    {
        $query = CaterGallery::where('user_id', $this->userId);
        if($this->search) {
            $query->where(function(Builder $query) {
                    $query->where('status', 'LIKE', "%$this->search%");
            });
        }

        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $galleries = $query->paginate($this->length);
        $galleries->setPath(route('admin.caters.view',$this->userId));

        return view('livewire.admin.cater.cater-gallery-datatable', compact('galleries'));
    }

    public function saveGallery() {
        
        $this->validate([
            'image' => 'required|mimes:png,jpg,svg,jpeg',
            'status' => 'required'
        ], [
            'image.required' => 'please select a image',
            'image.mimes' => 'please select only .png, .jpg, .jpeg or .svg only',
            'status.required' => 'status is required'
        ]);

        
        $gallery = new CaterGallery();
        $gallery->user_id = $this->userId;
        $gallery->status = $this->status;
        $gallery->image = $this->image->store('gallery', 'public');

        // dd($gallery, "demo vishal");
        $gallery->save();
        session()->flash('success', 'gallery added successfully.');
        if($this->front){
            return redirect()->route('web.user.profile');       
        }else{
            return redirect()->route('admin.caters.view', $this->userId);       
        }      
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
        $gallery = CaterGallery::findOrFail($this->deleteId);
        if(!empty($gallery) && $gallery->image !=null){
            $path = storage_path().'/app/public/';
            $file_old = $path.$gallery->image;
            if(file_exists($file_old)){
                unlink($file_old);
            }
        }
        $gallery->delete();  
    }
}
