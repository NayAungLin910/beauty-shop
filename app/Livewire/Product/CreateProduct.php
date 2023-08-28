<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    #[Rule('required|unique:products,name')]
    public $name;

    #[Rule('required')]
    public $description;

    #[Rule('required|image')]
    public $image;

    public $iteration;

    #[Rule('required|integer')]
    public $price;

    #[Rule('required')]
    public $selects = [];

    public $tags;

    public function mount()
    {
        $this->tags = Tag::orderBy('name')->select(['name', 'id'])->get();
    }

    public function submit()
    {
        $this->validate();

        $path = '/' . $this->image->store('images');

        $product = Product::create([
            'user_id' => Auth::user()->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $path,
            'price' => $this->price,
        ]);

        if ($product) {
            $product->tags()->sync($this->selects);

            $this->dispatch('success', message: 'A new product has been created!');

            $this->reset(['price', 'selects', 'name', 'description', 'image']);

            $this->iteration++;
        }
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.product.create-product');
    }
}
