<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\CaterVideo;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CaterVideoDatatable extends Component
{
    use WithPagination, WithFileUploads;
    public $video, $status='published';



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
        $query = CaterVideo::where('user_id', $this->userId);
        if($this->search) {
            $query->where(function(Builder $query) {
                $query->where('status', 'LIKE', "%$this->search%");
            });
        }

        foreach($this->order as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $videos = $query->paginate($this->length);
        $videos->setPath(route('admin.caters.view',$this->userId));

        return view('livewire.admin.cater.cater-video-datatable', compact('videos'));
    }

    public function saveVideo() {

        $this->validate([
            'video' => 'required|mimes:mp4',
            'status' => 'required'
        ], [
            'video.required' => 'please select a video',
            'video.mimes' => 'please select only .mp4 only',
            'status.required' => 'status is required'
        ]);


        $video = new CaterVideo();
        $video->user_id = $this->userId;
        $video->status = $this->status;
        $video->video = $this->video->store('video', 'public');
        $video->save();
        session()->flash('success', 'video added successfully.');
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
        $video = CaterVideo::findOrFail($this->deleteId);
        if(!empty($video) && $video->video !=null){
            $path = storage_path().'/app/public/';
            $file_old = $path.$video->video;
            if(file_exists($file_old)){
                unlink($file_old);
            }
        }
        $video->delete();
    }
    
}
