<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFiles extends Component
{
    use WithFileUploads;

    public $photos=[];

    public function render()
    {
        return view('livewire.upload-files');
    }

    public function save()
    {
        $this->validate([
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);

        foreach ($this->photos as $photo) {
            $photo->store('photos');
        }

        $this->photos=[];
        session()->flash('message','File Uploaded');
        // $this->photo->store('photos');
    }

    public function remove($index){
        array_splice($this->photos,$index,1);
    }
}
