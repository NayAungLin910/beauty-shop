<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Statistics extends Component
{
    public $top5MostBoughtProducts;

    public $yearlySales;

    public $totalUserCount;

    public $totalAdminCount;

    public $totalSalesCount;

    public $totalProductsCount;

    public function mount()
    {
        $products = Product::has('orders')->with('orders:id,user_id,quantity,product_id')->select('id', 'name')->get();

        $products = $products->pluck('total_buy_count', 'name')->sortDesc()->take(5);

        $this->top5MostBoughtProducts[] = $products->keys();
        $this->top5MostBoughtProducts[] = $products->values();

        $last3YearsSales = collect([
            date('Y') => Order::where('status', 'order')->whereYear('created_at', date('Y'))->get()->sum('sub_price'),
            date('Y') - 1 => Order::where('status', 'order')->whereYear('created_at', date('Y') - 1)->get()->sum('sub_price'),
            date('Y') - 2 => Order::where('status', 'order')->whereYear('created_at', date('Y') - 2)->get()->sum('sub_price'),
        ]);

        $this->yearlySales[] = $last3YearsSales->reverse()->keys();
        $this->yearlySales[] = $last3YearsSales->reverse()->values();
        
        $this->totalUserCount = User::where('role', '1')->count();
        $this->totalAdminCount = User::where('role', '2')->count();
        $this->totalSalesCount = Invoice::count();
        $this->totalProductsCount = Product::count();
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.admin.statistics');
    }
}
