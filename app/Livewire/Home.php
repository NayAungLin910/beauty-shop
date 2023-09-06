<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    public $latestProducts;

    public $popularProducts;

    public $tags;

    public function mount()
    {
        $this->popularProducts = Product::with('tags')->get()->sortBy('total_buy_count')->reverse()->take(5);

        $this->latestProducts = Product::latest()->with('tags')->get()->take(4);

        $this->tags = Tag::latest()->get();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.home');
    }
}
