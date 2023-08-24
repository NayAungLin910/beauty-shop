<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChangePassword extends Component
{
    #[Rule('required|string|confirmed')]
    public $password;

    public $password_confirmation;

    #[Rule('required|string')]
    public $old_password;

    public function save()
    {
        $this->validate();

        $user = Auth::user();

        if (!Hash::check($this->old_password, $user->password)) {
            $this->addError('old_password', ['The provided password is incorrect!']);
        } else {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($this->password),
            ]);

            $this->reset();

            $this->dispatch('success', message: 'Password has been updated!');
        }
    }

    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
