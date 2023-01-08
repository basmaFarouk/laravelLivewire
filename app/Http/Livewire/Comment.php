<?php

namespace App\Http\Livewire;

use App\Models\Comment as ModelsComment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Comment extends Component
{
    use WithPagination;
    use WithFileUploads;
    // public $comments;

    public $newComment;
    public $image;
    public $ticket_id;
    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected',
    ];

    public function handleFileUpload($imageData){
        $this->image=$imageData;
    }

    public function ticketSelected($ticket_id){
        $this->ticket_id=$ticket_id;
    }

    public function mount(){ //like a constructor in a class
        // dd($intialComments);
        // $intialComments=ModelsComment::with('creator')->get();
        // $this->comments=$intialComments;
    }

    public function remove($id){
        $comment=ModelsComment::find($id);
        if($comment->image){
            Storage::disk('public')->delete($comment->image);
        }
        // $this->comments=$this->comments->except($id);
        $comment->delete();
        session()->flash('message','Comment deleted successfully 😄');
    }

    public function render()
    {
        return view('livewire.comment',[
          "comments"=> ModelsComment::where('support_ticket_id',$this->ticket_id)->with('creator')->paginate(2)
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,['newComment'=>'required|max:255']);
    }

    public function addComment(){
        $this->validate(['newComment'=>'required']);
       $image= $this->storeImage();
        $createdComment=ModelsComment::create([
            'body'=>$this->newComment,
            'user_id'=>1,
            'image'=>$image,
            'support_ticket_id'=>$this->ticket_id
        ]);
        // $this->comments->prepend($createdComment);
        $this->newComment="";
        $this->image="";
        session()->flash('message','Comment added successfully');
    }

    public function storeImage(){
        if(!$this->image) return null;

        $name=Str::random().'.jpg';
        $img= ImageManagerStatic::make($this->image)->encode('jpg');
        Storage::disk('public')->put($name,$img);
        return $name;
    }

    public function getImagePhotoAttribute(){
        return ('storage/'.$this->image);
        // return asset('category/'.$this->image);
    }
}
