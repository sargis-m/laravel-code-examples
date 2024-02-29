<?php

use Livewire\Component;

class EmitExampleParentComponent extends Component
{
    public $receivedMessage;

    protected $listeners = ['messageSent' => 'getMessage'];

    public function getMessage($message)
    {
        $this->receivedMessage = $message;
    }

    public function render()
    {
        return view('livewire.emit-example-parent-component');
    }
}
