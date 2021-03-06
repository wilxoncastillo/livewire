<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_edit = false;
    public $post;
    public $identificador;
    public $image;
    public $readyToLoad = false;
    public $pages = 10;

    public $queryString = [
        'pages' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];


    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    protected $listeners = [
        'render' => 'render', 
        'delete',
    ];

    public function mount() { 
        $this->post = new Post();
        $this->identificador = rand();
    }

    public function render()
    {
        if($this->readyToLoad) {
            $posts = Post::where('title', 'like', '%' . $this->search .  '%')
                ->orWhere('content', 'like', '%' . $this->search .  '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pages);
        }else {
            $posts = [];
        }


        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort) { 
        if($this->sort == $sort) {
            if($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort; 
            $this->direction = 'asc';
        }
        $this->order = $sort;
    }

    public function edit(Post $post) { 
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update() {
        $this->validate();

        if($this->image) {
            Storage::delete($this->post->image);

            $this->post->image = $this->image->store('public/posts');
        }

        $this->post->save();

        $this->reset([
            'open_edit',
            'image'
        ]);

        $this->identificador = rand();

        $this->emit('alert', 'El post se actualizo sastifactoriamente');
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function loadPosts() {
        $this->readyToLoad = true;
    }

    public function delete(Post $post) {
        $post->delete();

        $this->emit('alert', 'El post se borro sastifactoriamente');
    }

    

}
