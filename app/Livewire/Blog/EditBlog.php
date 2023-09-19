<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBlog extends Component
{
    use WithFileUploads;

    public Blog $blog;

    #[Rule('required')]
    public $name;

    #[Rule('required|image')]
    public $image;

    public $iteration;

    #[Rule('required')]
    public $description;


    public function mount($id)
    {
        $this->blog = Blog::where('id', $id)->first();

        $this->name = $this->blog->name;
        $this->description = $this->blog->description;
    }

    public function submit()
    {
        $path = $this->blog->image;

        if ($this->image) {

            if (Storage::exists($this->blog->image) && $this->blog->image !== "/default_images/product_example_image.jpg") {
                Storage::delete($this->blog->image);
            }

            $path = '/' . $this->image->store('images');

            $this->reset('image');

            $this->iteration++; // causes the image input to reset value

        }

        $this->blog->name = $this->name;
        $this->blog->description = $this->description;
        $this->blog->image = $path;
        $this->blog->save();

        $this->dispatch('success', message: 'The blog information has been updated!');
    }
    
    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.blog.edit-blog');
    }
}
