<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $title;
    public $content;
    public $image;
    public $identificador;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048',
    ];

    public function mount() {
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save() {
        
        $this->validate();

        $image = $this->image->store('public/posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);

        $this->reset([
            'title',
            'content',
            'image',
            'open'
        ]);

        $this->identificador = rand();

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se creo sastifactoriamente');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function updatingOpen() { 
        $this->reset([
            'title',
            'content',
            'image',
        ]);

        $this->identificador = rand();
        $this->emit('resetCKEeditor');
    }
}
