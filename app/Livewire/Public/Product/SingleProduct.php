<?php

namespace App\Livewire\Public\Product;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SingleProduct extends Component
{
    public $product;
    public $cart = 0;

    public function mount($id)
    {
        $this->product = Product::where('id', $id)->first();

        if(Auth::check() && Auth::user()->role === '1'){
            $this->cart = $this->product->orders()->where('status', 'cart')->where('user_id', Auth::user()->id)->first()->quantity ?? 0;
        }

        // $this->cart = Auth::check() && Auth::user()->role == '1' ? $this->product->orders()->where('user_id', Auth::user()->id)->first()->quantity : '';
    }

    #[On('add-cart')]
    public function addCart($id, $quantity)
    {
        if ($quantity) {
            $order = Order::where('product_id', $id)->where('user_id', Auth::user()->id)->where('status', 'cart')->first();
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
                    $this->dispatch('cart-nav');
                    $this->dispatch('success', message: 'The product has been added to cart!');
                }
            }

            $this->cart = $this->product->orders()->where('status', 'cart')->where('user_id', Auth::user()->id)->first()->quantity;
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.product.single-product');
    }
}
