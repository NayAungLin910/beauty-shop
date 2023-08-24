<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $name;

    #[Rule('required|email')]
    public $email;

    #[Rule('nullable|image')]
    public $image = null;

    public $iteration; // for reseting the image input in client side

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function submit()
    {
        $this->validate();

        $path = Auth::user()->image;

        if ($this->image) {
            // if user uploaded a new profile, deletes the old profile if one exists
            if (Storage::exists(Auth::user()->image)) {
                Storage::delete(Auth::user()->image);
            }

            $path = '/' . $this->image->store('images');

            $this->iteration++; // cause the image input to reset value

            $this->dispatch('new-profile', src: $path);
        }

        User::where('id', Auth::user()->id)
            ->update([
                'name' => $this->name,
                'email' => $this->email,
                'image' => $path,
            ]);

        $this->dispatch('success', message: 'Profile updated!');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.profile');
    }
}
