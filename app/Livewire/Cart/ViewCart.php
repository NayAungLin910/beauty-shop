<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewCart extends Component
{
    public $orders;

    public $totalPrice;

    public $search;

    public $sort = 'latest';

    public function mount()
    {
        $this->orders = Order::query()->with('product');
    }

    public function resetFilter()
    {
        $this->reset();
        $this->resetPage();
    }

    public function delete($id)
    {
        $order = Order::where('id', $id)->first();

        if ($order) {
            $order->delete();

            $this->dispatch('success', message: 'Order has been removed!');
            $this->dispatch('cart-minus');
        }
    }

    #[On('product-buy')]
    public function buy()
    {
        Order::where('user_id', Auth::user()->id)->where('status', 'cart')->update([
            'status' => 'order'
        ]);

        $this->dispatch('cart-bought');

        $this->dispatch('success', message: 'Products purchased successfully!');
    }

    #[On('update-order-quantity')]
    public function updateQuantity($id, $quantity)
    {
        Order::where('id', $id)->update([
            'quantity' => $quantity,
        ]);

        $this->dispatch('success', message: 'Product quantity updated!');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $this->orders = Order::query()->with('product');

        $this->orders = $this->sort === 'latest' ? $this->orders->latest() : $this->orders->oldest();

        $this->orders = $this->orders->where('user_id', Auth::user()->id)->where('status', 'cart')->get();

        $this->totalPrice = $this->orders->sum('sub_price');

        return view('livewire.cart.view-cart');
    }
}
