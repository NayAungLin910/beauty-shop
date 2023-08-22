<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Statistics extends Component
{
    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.admin.statistics');
    }
}
