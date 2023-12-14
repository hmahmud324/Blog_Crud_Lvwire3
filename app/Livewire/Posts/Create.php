<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use App\Models\Post;

class Create extends Component
{
    use WithFileUploads;

    #[Rule("required|max:1024")]
    public $image;

    #[Rule("required|min:5")]
    public $title;

    #[Rule("required|min:3|max:500")]
    public $content;

    public function store()
    {
        $this->validate();

        $this->image->storeAs("public/posts", $this->image->hashName());

        Post::create([
            "image" => $this->image->hashName(),
            "title" => $this->title,
            "content" => $this->content
        ]);

        session()->flash("message", "Post Created.");

        return redirect()->route("posts.index");
    }

    public function render()
    {
        return view('livewire.posts.create')->layoutData([
            "title" => "Create Post Page"
        ]);
    }
}
