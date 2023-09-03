<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ViewProduct extends Component
{
    use WithPagination;

    public $search = '';

    public $sort = 'latest';

    public $min = 0;

    public $max = 0;

    public $tags;

    public $tagId = 'default-tag';

    public function mount()
    {
        $this->tags = Tag::orderBy('name')->select('id', 'name')->get();
    }

    public function resetFilter()
    {
        $this->resetExcept('tags');
        $this->resetPage();
    }

    #[On('product-delete')]
    public function delete($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product) {
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
        }

        $product->tags()->sync([]);

        $product->delete();

        $this->dispatch('success', message: 'A product has been deleted!');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        $products = Product::query();

        if ($this->search) {
            $products = $products->where('name', 'like', "%$this->search%");
        }

        $products = $this->sort === 'latest' ? $products->latest() : $products->oldest();

        if ($this->min || $this->max) {
            $products = $products->whereBetween('price', [$this->min, $this->max]);
        }

        if ($this->tagId !== 'default-tag') {
            $products = $products->whereHas('tags', function (Builder $query) {
                $query->where('tags.id', $this->tagId);
            });
        }

        $products = $products->latest();

        $products = $products->with('orders')->with('tags:id,name')->paginate(10);

        return view('livewire.product.view-product', compact('products'));
    }
}
