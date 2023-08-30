<?php

namespace App\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Account extends Component
{
    use WithPagination;

    public $type = 'all';

    public $search = '';

    public $sort = 'latest';

    public function resetFilter()
    {
        $this->reset();
        $this->resetPage();
    }

    #[On('user-change')]
    public function changeAdmin($id)
    {
        $user = User::where('id', $id)->first();
        $user->role = '2';
        $user->save();

        $this->dispatch('success', message: 'User role changed!');
    }

    #[On('user-delete')]
    public function delete($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            // deletes the profile if exists
            if (Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $user->delete();

            $this->dispatch('success', message: 'A user has been deleted!');
        }
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        $users = User::query();

        if ($this->search) {
            $users = $users->where('name', 'like', "%$this->search%");
        }

        $users = match ($this->type) {
            'admin' => $users->where('role', '2'),
            'user' => $users->where('role', '1'),
            default => $users,
        };

        $users = $this->sort === 'latest' ? $users->latest() : $users->oldest();

        $users = $users->whereNot('id', Auth::user()->id)->paginate(10);

        return view('livewire.account.account', compact('users'));
    }
}