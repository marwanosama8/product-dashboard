<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShowProducts extends Component
{

    public $selected = [
        'category' => [],
        'name' => [],
    ];

    public function render()
    {
        $products = Product::withFilters(
            $this->selected['category'],
            $this->selected['name'],
        )->get();

        return view('livewire.show-products', compact('products'));
    }
}
