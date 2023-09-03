<?php

namespace App\Livewire\Public\Product;

use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

    public function mount($tagId = 'default-tag')
    {
        $this->tagId = $tagId;

        $this->tags = Tag::orderBy('name')->select('id', 'name')->get();
    }

    public function resetFilter()
    {
        $this->resetExcept('tags');
        $this->resetPage();
    }

    #[On('add-cart')]
    public function addCart($id, $quantity)
    {
        if ($quantity) {
            $order = Order::where('product_id', $id)->where('status', 'cart')->first();
            if ($order) {
                $order->quantity += $quantity;
                $order->save();

                $this->dispatch('success', message: 'The product has been added to cart!');
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $id,
                    'quantity' => $quantity,
                ]);

                if ($order) {
                    $this->dispatch('success', message: 'The product has been added to cart!');
                }
            }
        }
    }

    #[Layout('components.layouts.app')]
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

        $products = $products->paginate(10);

        return view('livewire.public.product.view-product', compact('products'));
    }
}
