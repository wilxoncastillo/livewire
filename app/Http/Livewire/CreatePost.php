<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;
    public $title;
    public $content;

    protected $rules = [
        'title' => 'required|max:10',
        'content' => 'required|min:100',
    ];

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save() {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset([
            'title',
            'content',
            'open'
        ]);

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se creo sastifactoriamente');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
}
