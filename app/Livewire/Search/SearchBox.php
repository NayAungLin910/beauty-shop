<?php

namespace App\Livewire\Search;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;

class SearchBox extends Component
{
    public $search;

    public $tags;

    public $products;

    public function render()
    {
        if ($this->search) {
            $this->tags = Tag::where('name', 'like', "%$this->search%")->select('name', 'id')->get()->take(5);
            $this->products = Product::where('name', 'like', "%$this->search%")->select('name', 'id', 'image')->get()->take(3);
        } else {
            $this->resetExcept('search');
        }
        return view('livewire.search.search-box');
    }
}
