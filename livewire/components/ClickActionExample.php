<?php

use Livewire\Component;

class ClickActionExample extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.click-action-example');
    }
}
