<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ViewInvoice extends Component
{
    use WithPagination;

    public $sort = 'latest';

    #[Layout('components.layouts.app')]
    public function render()
    {
        $invoices = Invoice::query();

        $invoices = $this->sort === 'latest' ? $invoices->latest() : $invoices->oldest();

        $invoices = $invoices->where('user_id', Auth::user()->id)->with('orders')->paginate(5);

        return view('livewire.invoice.view-invoice', compact('invoices'));
    }
}
