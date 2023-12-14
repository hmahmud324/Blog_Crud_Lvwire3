<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $postID;
    #[Rule("required|max:1024|image")]
    public $image;

    #[Rule("required|min:5")]
    public $title;

    #[Rule("required|min:3|max:500")]
    public $content;

    public $imageName;

    public function mount($id)
    {
        $post = Post::find($id);
        
        $this->postID       = $post->id;
        $this->title        = $post->title;
        $this->content      = $post->content;
        $this->imageName    = $post->image;
    }

    public function update()
    {
        $this->validate();

        $post = Post::find($this->postID);

        if($this->image){
            $this->image->storeAs("public/posts", $this->image->hashName());

            Storage::delete("public/posts/".$post->image);

            $post->update([
                "image"     => $this->image->hashName(),
                "title"     => $this->title,
                "content"   => $this->content,
            ]);
        }else{
            $post->update([
                "title" => $this->title,
                "content" => $this->content,
            ]);
        }

        session()->flash("message", "Post Updated");

        return redirect()->route("posts.index");
    }

    public function render()
    {
        return view('livewire.posts.edit')->layoutData([
            "title" => "Edit Post Page"
        ]);
    }
}
