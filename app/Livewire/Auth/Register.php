<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $name = '';

    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public $password = '';

    #[Rule('required|image')]
    public $image;

    public $remember = true;

    public function submit()
    {
        $this->validate();

        $path = '/' . $this->image->store('images'); // store the image in default disk under images directory

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'image' => $path,
        ]);

        Auth::login($user, $this->remember);

        return redirect()->route('home')->with('success', 'Registered and logged in successfully!');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}