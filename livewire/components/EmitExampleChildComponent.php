<?php

use Livewire\Component;

class EmitExampleChildComponent extends Component
{
    public $message = 'Hello from child!';

    public function sendMessage()
    {
        $this->emit('messageSent', $this->message);
    }

    public function render()
    {
        return view('livewire.emit-example-child-component');
    }
}
