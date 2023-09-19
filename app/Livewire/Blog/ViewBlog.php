<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
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

    #[On('blog-delete')]
    public function delete($id)
    {
        $blog = Blog::where('id', $id)->first();

        if ($blog) {
            if (Storage::exists($blog->image) && $blog->image !== '/default_images/product_example_image.jpg') {
                Storage::delete($blog->image);
            }
        }

        $blog->delete();

        $this->dispatch('success', message: 'A product has been deleted!');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        $blogs = Blog::query();

        if ($this->search) {
            $blogs = $blogs->where('name', 'like', "%$this->search%");
        }

        $blogs = $blogs->latest()->paginate(10);

        return view('livewire.blog.view-blog',  compact('blogs'));
    }
}
