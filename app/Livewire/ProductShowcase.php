<?php

namespace App\Livewire;

use Livewire\Component;

class ProductShowcase extends Component
{
    public $products = [];

    public function mount()
    {
        $this->products = \App\Models\Product::latest()->take(8)->get();
    }

    public function render()
    {
        return view('livewire.product-showcase');
    }
}
