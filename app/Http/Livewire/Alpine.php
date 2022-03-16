<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alpine extends Component
{
    public $count=10;
    
    public function render()
    {
        return view('livewire.alpine');
    }

    public function incrementar() {
        $this->count++;
    }
}
