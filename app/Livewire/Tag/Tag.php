<?php

namespace App\Livewire\Tag;

use App\Models\Tag as ModelsTag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Tag extends Component
{
    use WithPagination;

    #[Rule('required|unique:tags,name')]
    public $name;

    public $search;

    public $sort = 'latest';

    public $edit;

    public function submit()
    {
        $this->validate();

        $tag = ModelsTag::create([
            'name' => $this->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($tag) {
            $this->dispatch('success', message: 'A new tag has been created!');
        }
    }

    #[On('tag-delete')]
    public function delete($id)
    {
        $tag = ModelsTag::where('id', $id)->first();

        if ($tag) {

            $tag->delete();

            $this->dispatch('success', message: 'A tag has been deleted!');
        }
    }

    public function update($id)
    {
        $this->validate([
            'edit' => 'required|unique:tags,name'
        ]);

        $tag = ModelsTag::where('id', $id)->first();

        if ($tag) {
            $tag->update([
                'name' => $this->edit
            ]);

            $this->dispatch('success', message: 'A tag has been updated!');
            
            $this->dispatch('close');
        }

        $this->reset('edit');
    }

    public function cancel()
    {
        $this->reset('edit');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        $tags = ModelsTag::query();

        if ($this->search) {
            $tags = $tags->where('name', 'like', "%$this->search%");
        }

        $tags = $this->sort === 'latest' ? $tags->latest() : $tags->oldest();

        $tags = $tags->withCount('products')->paginate(10);

        return view('livewire.tag.tag', [
            'tags' => $tags,
        ]);
    }
}
