<?php

namespace App\Livewire\Public\Blog;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ViewBlog extends Component
{
    use WithPagination;

    public $search = '';

    public function resetFilter()
    {
        $this->reset();
        $this->resetPage();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {

        $blogs = Blog::query();

        if ($this->search) {
            $blogs = $blogs->where('name', 'like', "%$this->search%");
        }

        $blogs = $blogs->latest()->paginate(10);

        return view('livewire.public.blog.view-blog', compact('blogs'));
    }
}
