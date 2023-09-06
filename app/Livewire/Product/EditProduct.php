<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;

    public $name;

    public $description;

    #[Rule('nullable|image')]
    public $image;

    public $iteration;

    public $selects = [];

    public $tags;

    public function mount($id)
    {
        $this->product = Product::where('id', $id)->first();

        $this->tags = Tag::orderBy('name')->get();

        $product_id = $this->product->id;

        $this->name = $this->product->name;

        $this->description = $this->product->description;

        $this->selects = Tag::whereHas('products', function (Builder $query) use($product_id) {
            $query->where('products.id', $product_id);
        })->get()->pluck('id');
    }

    public function submit()
    {
        // $this->validate([
        //     'name' => 'required|unique:products,name,' . $this->product->id,
        //     'image' => 'nullable|image',
        //     'description' => 'required',
        // ]);

        $path = $this->product->image;

        if ($this->image) {
            // if a new profile is uploaded, deletes the old profile if one exists
            if (Storage::exists($this->product->image)) {
                Storage::delete($this->product->image);
            }

            $path = '/' . $this->image->store('images');

            $this->reset('image');

            $this->iteration++; // causes the image input to reset value

        }

        $this->product->tags()->sync($this->selects);

        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->image = $path;
        $this->product->save();

        $this->dispatch('success', message: 'The product information has been updated!');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.product.edit-product');
    }
}
