<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public function destroy(Post $post)
    {
        
        $post->delete();

        Storage::delete("public/posts/".$post->image);

        session()->flash("message", "Post Deleted.");

        redirect()->route("posts.index");
    }

    public function render()
    {
        return view('livewire.posts.index', [
            "posts" => Post::latest()->paginate(5)
        ])->layoutData([
            "title" => "Blog Posts Page"
        ]);
    }
}
