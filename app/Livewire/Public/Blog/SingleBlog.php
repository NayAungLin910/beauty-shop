<?php

namespace App\Livewire\Public\Blog;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SingleBlog extends Component
{
    public Blog $blog;

    public function mount($id)
    {
        $this->blog = Blog::where('id', $id)->first();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.blog.single-blog');
    }
}
