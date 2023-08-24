<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public $password = '';

    public $remember = true;

    public function submit()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {

            $route = Auth::user()->role == '2' ? 'admin.statistics' : 'home';

            return redirect()->route($route)->with('success', 'Logined successfully!');
        } else {
            $this->addError('password', ['The provided email or password is incorrect!']);
        }
    }

    #[Layout('components.layouts.unauth')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}