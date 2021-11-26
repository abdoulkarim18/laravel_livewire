<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class Comments extends Component
{
    use WithPagination;
    // public $comments;
    public $newComment;

    public $image;

    public $ticketId;

    // Uploader une Image
    protected $listeners = [

        'fileUpload' => 'handleFileUpload',

        "ticketSelected",

    ];

    public function ticketSelected($ticketId){

        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData){

        // dd($imageData);
        $this->image = $imageData;
    }

    // Validation en temps réel
    public function updated($field){

        $this->validateOnly($field, [

            'newComment'=> 'required|max:255'
        ]);
    }

    // Ajouter Un commentaire
    public function addComment(){

        $this->validate(['newComment'=> 'required|max:255']);

        // if($this->newComment == ''){

        //     return;
        // }
       $image = $this->storeImage();

     $createdComment = Comment::create([

        'body'=>$this->newComment,

        'user_id' => 1,

        'image' => $image,

        'support_ticket_id' => $this->ticketId,

    ]);

    // ICI je met en commentaire a cause de la pagination(pour qu'on puisse add un new comment)
    //  $this->comments->prepend($createdComment);

        $this->newComment = "";

        $this->image = "";

        // Message flash
        session()->flash('message','Comment add succcessfully 😀');
    }

    public function storeImage(){

        if (! $this->image) {

            return null;
        }

        // Il encode le nom de l'image ex:1dfedjke12h...
        $img = ImageManagerStatic::make($this->image)->encode('jpg');

        // Nomme l'image et je concataine en jpg
        $name = Str::random() . '.jpg';

        // Le dossier de sauvegarde.
        Storage::disk('public')->put($name, $img);

        return $name;
    }
    // Supprimer Un commentaire
    public function remove($commentId){

        // dd($commentId);
        $comment =Comment::find($commentId);
        // dd($comment);
        $comment->delete();

        //Supprimer une image
        Storage::disk('public')->delete($comment->image);

        // ICI je met en commentaire a cause de la pagination(pour qu'on puisse delete)
        // $this->comments = $this->comments->except($commentId);

        // Message flash
        session()->flash('message','Comment deleted succcessfully 🙁');
    }

    public function render()
    {
        return view('livewire.comments',[

            'comments'=> Comment::where('support_ticket_id',$this->ticketId)->latest()->paginate(2),
        ]);
    }
}
