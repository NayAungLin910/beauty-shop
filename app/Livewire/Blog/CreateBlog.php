<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBlog extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $name;

    #[Rule('required|image')]
    public $image;

    public $iteration;

    #[Rule('required')]
    public $description;

    public function submit()
    {
        $this->validate();

        $path = '/' . $this->image->store('images');

        $blog = Blog::create([
            'name' => $this->name,
            'image' => $path,
            'description' => $this->description
        ]);

        if($blog) {

            $this->dispatch('success', message: 'A new blog has been created!');

            $this->reset(['name', 'image', 'description']);

            $this->iteration++;
        }
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.blog.create-blog');
    }
}
