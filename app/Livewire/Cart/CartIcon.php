<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $count;

    public function mount()
    {
        $this->count = Auth::check() ? Order::where('status', 'cart')->where('user_id', Auth::user()->id)->count() : 0;
    }

    #[On('cart-nav')]
    public function addCart()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.cart.cart-icon');
    }
}
